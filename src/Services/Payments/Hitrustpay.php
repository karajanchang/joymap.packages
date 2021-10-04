<?php

namespace Joymap\Services\Payments;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\TransferStats;
use Illuminate\Support\Facades\Log;

class Hitrustpay
{
    private $url;
    private $refererUrl;
    private $callbackUrl;

    public function __construct()
    {
        $this->url = env('HITRUST_URL', 'https://testtrustlink.hitrust.com.tw/TrustLink/TrxReqForJava');
        $this->refererUrl = env('HITRUST_REFERER_URL', 'https://member-test.twdd.tw');
        $this->callbackUrl = env('HITRUST_CALLBACK_URL', 'https://webapi-test.joymap.tw/credit-card/callback');
    }

    public function auth($params)
    {
        $params = [
            'Type' => 'Auth',
            'storeid' => $params['storeId'],
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
            'storeid' => $params['storeId'],
            'ordernumber' => $params['orderNumber'],
            'queryflag' => $params['queryFlag'] ?? 1,
            'merUpdateURL' => $params['callbackUrl'] ?? $this->callbackUrl,
        ];

        return $this->post($params);
    }

    public function refund($params)
    {
        $params = [
            'Type' => 'Refund',
            'storeid' => $params['storeId'],
            'ordernumber' => $params['orderNumber'],
            'amount' => $params['amount'],
            'queryflag' => $params['queryFlag'] ?? 1,
            'merUpdateURL' => $params['callbackUrl'] ?? $this->callbackUrl,
        ];

        return $this->post($params);
    }

    public function authTrxToken($params)
    {
        $params = [
            'Type' => 'AUTH_TRXTOKEN',
            'storeid' => $params['storeId'],
            'ordernumber' => $params['orderNumber'],
            'amount' => $params['amount'],
            'orderdesc' => $params['orderDesc'],
            'depositflag' => $params['depositFlag'] ?? 1,
            'queryflag' => $params['queryFlag'] ?? 1,
            'returnURL' => $params['returnUrl'] ?? $this->callbackUrl,
            'merUpdateURL' => $params['callbackUrl'] ?? $this->callbackUrl,
            'trxToken' => $params['trxToken'],
            'expiry' => $params['expiry'],
        ];

        return $this->post($params);
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
                $parts = parse_url($redirectUrl);
                if (isset($parts['query'])) {
                    parse_str($parts['query'], $query);
                    return $query;
                }
            }

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
