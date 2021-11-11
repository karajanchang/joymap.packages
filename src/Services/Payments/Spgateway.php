<?php

namespace Joymap\Services\Payments;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\TransferStats;
use Illuminate\Support\Facades\Log;
use Joymap\Models\Store;

class Spgateway implements pay
{
    private $url;
    private $store;

    public function getAmountMultiplicand(): int
    {
        return 1;
    }

    /**
     * @throws \Exception
     */
    public function setStore(Store $store): Spgateway
    {
        $this->store = $store;
        if (
            empty($this->store->storeSpgateway->merchant_id) ||
            empty($this->store->storeSpgateway->merchant_iv_key) ||
            empty($this->store->storeSpgateway->merchant_hash_key)
        ) {
            throw new \Exception('智付通商店尚未啟用', 422);
        }
        if (($this->store->can_pay ?? 0) == 0) {
            throw new \Exception('商店未啟用支付功能', 422);
        }
        return $this;
    }

    // 綁卡
    public function bindCard(array $params)
    {
        $this->url = env('SPGATEWAY_CREDIT_CARD_URL', 'https://ccore.spgateway.com/API/CreditCard');
        $params = [
            'TimeStamp' => time(),
            'Version' => '1.0',
            'MerchantOrderNo' => $params['orderNumber'],
            'Amt' => $params['amount'],
            'ProdDesc' => $params['orderDesc'],
            'PayerEmail' => $params['email'],
            'CardNo' => $params['cardNo'],
            'Exp' => $params['expiry'],
            'CVC' => $params['cvc'],
            'TokenSwitch' => 'get',// 拿 token 使用 get
            'TokenTerm' => $params['email'],
            'TokenLife' => $params['expiry'],
        ];

        $params = $this->preparePostData($params);
        return $this->post($params);
    }

    // 刷卡
    public function pay(array $params)
    {
        $this->url = env('SPGATEWAY_CREDIT_CARD_URL', 'https://ccore.spgateway.com/API/CreditCard');
        $params = [
            'TimeStamp' => time(),
            'Version' => '1.0',
            'MerchantOrderNo' => $params['orderNumber'],
            'Amt' => $params['amount'],
            'ProdDesc' => $params['orderDesc'],
            'PayerEmail' => $params['email'],
            'TokenValue' => $params['token'],
            'TokenTerm' => $params['email'],
            'TokenSwitch' => 'on',// 刷卡使用 on
        ];
        $params = $this->preparePostData($params);
        return $this->post($params);
    }

    // 取消授權
    public function cancel($params)
    {
        $this->url = env('SPGATEWAY_CANCEL_URL', 'https://ccore.spgateway.com/API/CreditCard/Cancel');
        $params = [
            'RespondType' => 'JSON',
            'Version' => '1.0',
            'Amt' => $params['amount'],
            'MerchantOrderNo' => $params['orderNumber'],
            'TimeStamp' => time(),
            'IndexType' => 1,
        ];
        $params = $this->preparePostData($params);
        return $this->post($params);
    }

    // 查詢訂單
    public function query($params)
    {
        $this->url = env('SPGATEWAY_QUERY_URL', 'https://ccore.spgateway.com/API/QueryTradeInfo');
        $params = [
            'MerchantID' => $this->store->storeSpgateway->merchant_id,
            'MerchantOrderNo' => $params['orderNumber'],
            'Amt' => $params['amount'],
        ];
        $params = $this->preparePostDataHasCkcekValue($params);
        return $this->post($params);
    }

    private function preparePostDataHasCkcekValue(array $data)
    {
        ksort($data);
        $CheckValue = sprintf(
            'IV=%s&%s&Key=%s',
            $this->store->storeSpgateway->merchant_iv_key,
            http_build_query($data),
            $this->store->storeSpgateway->merchant_hash_key
        );
        $CheckValue = strtoupper(hash("sha256", $CheckValue));
        $data['Version'] = '1.1';
        $data['RespondType'] = 'JSON';
        $data['TimeStamp'] = time();
        $data['CheckValue'] = $CheckValue;
        Log::info('preparePostDataHasCkcekValue 最後送出的資料：', $data);

        return $data;
    }

    private function preparePostData(array $data): array
    {
        $postDataStr = http_build_query($data);
        $encryptData = $this->encrypt($postDataStr);

        $postData = [
            'MerchantID_' => $this->store->storeSpgateway->merchant_id,
            'Pos_' => 'JSON',
            'PostData_' => $encryptData,
        ];
        Log::info('preparePostData 最後送出的資料：', $postData);

        return $postData;
    }

    private function encrypt($str = ''): string
    {
        $str = $this->addPadding($str);
        $str = openssl_encrypt(
            $str,
            'aes-256-cbc',
            $this->store->storeSpgateway->merchant_hash_key,
            OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,
            $this->store->storeSpgateway->merchant_iv_key
        );
        return trim(bin2hex($str));
    }

    private function addPadding($string = '', $blockSize = 32): string
    {
        $len = strlen($string);
        $pad = $blockSize - ($len % $blockSize);
        $string .= str_repeat(chr($pad), $pad);

        return $string;
    }

    private function post($params)
    {
        try {
            $client = new Client();
            $res = $client->post(
                $this->url, [
                    'form_params' => $params,
                ]
            );

            return json_decode($res->getBody()->getContents(), true);
        } catch (ClientException $e) {
            Log::error(__CLASS__.'::'.__METHOD__.' ClientException: ', [$e]);
        } catch (\Exception $e) {
            $msg = env('APP_DEBUG') === true ? $e->getMessage() : null;
            Log::error(__CLASS__.'::'.__METHOD__.' error: '.$msg, [$e]);
        }

        return false;
    }
}
