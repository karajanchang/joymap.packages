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
            'TokenTerm' => 'JOYMAP',
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
            'TokenTerm' => 'JOYMAP',
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

    // 退刷
    public function close($params)
    {
        $this->url = env('SPGATEWAY_CLOSE_URL', 'https://ccore.spgateway.com/API/CreditCard/Close');
        $params = [
            'RespondType' => 'JSON',
            'Version' => '1.0',
            'Amt' => $params['amount'],
            'MerchantOrderNo' => $params['orderNumber'],
            'TimeStamp' => time(),
            'IndexType' => 1,
            'CloseType' => 2,
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

    // 跟 store 抽費用到 金流合作推廣商 (SPGATEWAY_STORE_PARTNER_ID)
    public function chargeInstruct($params)
    {
        $this->url = env('SPGATEWAY_CHARGE_INSTRUCT_URL', 'https://ccore.spgateway.com/API/ChargeInstruct');
        $params = [
            'Version' => '1.0',
            'TimeStamp' => time(),
            'MerchantID' => $this->store->storeSpgateway->merchant_id,
            'Amount' => $params['amount'],
            'FeeType' => $params['fee_type'] ?? 4, // 4 其他費用
            'BalanceType' => $params['balance_type'] ?? 0, // 0為正向，1為負向。 例:平台商向合作商店收取費用時，則 填入0;平台商退還費用給合作商店 時，則填入1。
        ];
        $params = $this->preparePostDataUsePartnerId($params);
        return $this->post($params);
    }

    private function preparePostDataUsePartnerId(array $data): array
    {
        $postDataStr = http_build_query($data);
        $encryptData = $this->encrypt($postDataStr, env('SPGATEWAY_MERCHANT_HASH_KEY'), env('SPGATEWAY_MERCHANT_IV_KEY'));

        $postData = [
            'PartnerID_' => env('SPGATEWAY_STORE_PARTNER_ID', 'TWDD'),
            'PostData_' => $encryptData,
        ];
        Log::info('preparePostDataUsePartnerId 最後送出的資料：', $postData);

        return $postData;
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

        if (env('APP_ENV') != 'production') {
            Log::info('preparePostData 最後送出的資料：', $postData);
        }

        return $postData;
    }

    private function encrypt($str = '', $merchantHashKey = '', $merchantIvKey = ''): string
    {
        $str = $this->addPadding($str);
        $str = openssl_encrypt(
            $str,
            'aes-256-cbc',
            $merchantHashKey ?: $this->store->storeSpgateway->merchant_hash_key,
            OPENSSL_RAW_DATA | OPENSSL_ZERO_PADDING,
            $merchantIvKey ?: $this->store->storeSpgateway->merchant_iv_key
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
