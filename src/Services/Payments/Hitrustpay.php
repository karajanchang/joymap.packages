<?php

namespace Joymap\Services\Payments;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\TransferStats;
use Illuminate\Support\Facades\Log;
use Joymap\Models\Store;

class Hitrustpay implements pay
{
    private $url;
    private $refererUrl;
    private $callbackUrl;
    private $store;

    public function __construct()
    {
        $this->url = env('HITRUST_URL', 'https://testtrustlink.hitrust.com.tw/TrustLink/TrxReqForJava');
        $this->refererUrl = env('HITRUST_REFERER_URL', 'https://member-test.twdd.tw');
        $this->callbackUrl = env('HITRUST_CALLBACK_URL', 'https://webapi-test.joymap.tw/credit-card/callback');
    }

    public function getAmountMultiplicand(): int
    {
        return 100;
    }

    /**
     * @throws \Exception
     */
    public function setStore(Store $store): Hitrustpay
    {
        $this->store = $store;
        if (!$this->store->qrcode_no) {
            throw new \Exception('商店沒有 store_id', 422);
        }
        return $this;
    }

    public function bindCard(array $params)
    {
        $params = [
            'Type' => 'Auth',
            'storeid' => $this->store->qrcode_no ?? $params['storeId'],
            'ordernumber' => $params['orderNumber'],
            'amount' => $params['amount'],
            'orderdesc' => $params['orderDesc'],
            'depositflag' => $params['depositFlag'] ?? 0,
            'queryflag' => $params['queryFlag'] ?? 1,
            'returnURL' => $params['returnUrl'] ?? $this->callbackUrl,
            'merUpdateURL' => $params['callbackUrl'] ?? $this->callbackUrl,
            'pan' => $params['cardNo'],
            'expiry' => $params['expiry'],
            'e01' => $params['cvc'],
            'e55' => 1,
        ];

        return $this->post($params, true);
    }

    public function authRe($params)
    {
        $params = [
            'Type' => 'AuthRe',
            'storeid' => $this->store->qrcode_no ?? $params['storeId'],
            'ordernumber' => $params['orderNumber'],
            'queryflag' => $params['queryFlag'] ?? 1,
            'merUpdateURL' => $params['callbackUrl'] ?? $this->callbackUrl,
        ];

        return $this->post($params);
    }

    public function cancel(array $params)
    {
        $params = [
            'Type' => 'Refund',
            'storeid' => $this->store->qrcode_no ?? $params['storeId'],
            'ordernumber' => $params['orderNumber'],
            'amount' => $params['amount'],
            'queryflag' => $params['queryFlag'] ?? 1,
            'merUpdateURL' => $params['callbackUrl'] ?? $this->callbackUrl,
        ];

        return $this->post($params);
    }

    public function close(array $params)
    {
        // TODO: Implement close() method.
        return false;
    }

    public function pay(array $params)
    {
        $params = [
            'Type' => 'AUTH_TRXTOKEN',
            'storeid' => $this->store->qrcode_no ?? $params['storeId'],
            'ordernumber' => $params['orderNumber'],
            'amount' => $params['amount'],
            'orderdesc' => $params['orderDesc'],
            'depositflag' => $params['depositFlag'] ?? 1,
            'queryflag' => $params['queryFlag'] ?? 1,
            'returnURL' => $params['returnUrl'] ?? $this->callbackUrl,
            'merUpdateURL' => $params['callbackUrl'] ?? $this->callbackUrl,
            'trxToken' => $params['token'],
            'expiry' => $params['expiry'],
        ];

        return $this->post($params);
    }

    public function query(array $params)
    {
        // TODO: Implement query() method.
        return false;
    }

    public function post($params, $getUrl = false)
    {
        try {
            $redirectUrl = '';
            $client = new Client();
            $res = $client->post(
                $this->url,
                [
                    'form_params' => $params,
                    'headers' => [
                        'Referer' => $this->refererUrl,
                    ],
                    'on_stats' => function (TransferStats $stats) use (&$redirectUrl) {
                        $redirectUrl = $stats->getHandlerStats()['redirect_url'];
                    },
                    'allow_redirects' => false,
                ]
            );

            if ($redirectUrl) {
                if ($getUrl) {
                    return $redirectUrl;
                }
                $partsQuery = $this->mb_parse_url($redirectUrl, PHP_URL_QUERY);
                parse_str($partsQuery, $query);
                return $query;

            }

            return json_decode($res->getBody()->getContents(), true);
        } catch (ClientException $e) {
            Log::error(__CLASS__ . '::' . __METHOD__ . ' ClientException: ', [$e]);
        } catch (\Exception $e) {
            $msg = env('APP_DEBUG') === true ? $e->getMessage() : null;
            Log::error(__CLASS__ . '::' . __METHOD__ . ' error: ' . $msg, [$e]);
        }

        return false;
    }

    /**
     * 解析網址中文問題
     * @param $url
     * @param int $component
     * @return array|false|int|mixed|string|null
     */
    private function mb_parse_url($url, $component = -1)
    {
        $encodedUrl = preg_replace_callback('%[^:/?#=\.]+%usD', function ($matches) {
            return urlencode($matches[0]);
        }, $url);
        $components = parse_url($encodedUrl, $component);
        if (is_array($components)) {
            foreach ($components as &$part) {
                if (is_string($part)) {
                    $part = urldecode($part);
                }
            }
        } else if (is_string($components)) {
            $components = urldecode($components);
        }
        return $components;
    }
}
