<?php

namespace Joymap\Services\Payments;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\TransferStats;
use Illuminate\Support\Facades\Log;
use Joymap\Models\Store;
use Joymap\Models\StoreSpgateway;

class Spgateway implements pay
{
    private $url;
    private $store;

    public function getAmountMultiplicand(): int
    {
        return 1;
    }

    public function setStore(Store $store): Spgateway
    {
        $this->store = $store;
        if (!$this->store->storeSpgateway) {
            throw new \Exception('商店沒有 store_spgateway', 422);
        }
        return $this;
    }

    /**
     * 綁卡
     * @throws \Exception
     */
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

    /**
     * 刷卡
     * @throws \Exception
     */
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

    /**
     * 取消授權
     * @throws \Exception
     */
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

    private function preparePostData(array $data): array
    {
        $postDataStr = http_build_query($data);
        $encryptData = $this->encrypt($postDataStr);

        $postData = [
            'MerchantID_' => $this->store->storeSpgateway->merchant_id,
            'Pos_' => 'JSON',
            'PostData_' => $encryptData,
        ];
        Log::info('付款最後送出的資料：', $postData);

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
        if (!$this->url) {
            throw new \Exception('url is null', 422);
        }

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
