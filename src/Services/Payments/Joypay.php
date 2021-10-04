<?php

namespace Joymap\Services\Payments;


class Joypay
{
    private $hitrust;
    private $token;
    private $amount;
    private $storeId;
    private $orderNumber;
    private $expiry;
    private $cvc;
    private $cardNo;
    private $phone;
    private $returnUrl = null;
    private $callbackUrl = null;

    public function __construct()
    {
        $this->hitrust = app(Hitrustpay::class);
    }

    public function storeId($storeId): Joypay
    {
        $this->storeId = $storeId;
        return $this;
    }

    public function token($token): Joypay
    {
        $this->token = $token;
        return $this;
    }

    public function money($amount): Joypay
    {
        $this->amount = $amount * 100;
        return $this;
    }

    public function orderNo($orderNumber): Joypay
    {
        $this->orderNumber = $orderNumber;
        return $this;
    }

    public function expiry($expiry): Joypay
    {
        $this->expiry = $expiry;
        return $this;
    }

    public function cardNo($cardNo): Joypay
    {
        $this->cardNo = $cardNo;
        return $this;
    }

    public function cvc($cvc): Joypay
    {
        $this->cvc = $cvc;
        return $this;
    }

    public function phone($phone): Joypay
    {
        $this->phone = $phone;
        return $this;
    }

    public function returnUrl($returnUrl): Joypay
    {
        $this->returnUrl = $returnUrl;
        return $this;
    }

    public function callbackUrl($callbackUrl): Joypay
    {
        $this->callbackUrl = $callbackUrl;
        return $this;
    }

    private function reset()
    {
        $this->token = null;
        $this->amount = null;
        $this->storeId = null;
        $this->orderNumber = null;
        $this->expiry = null;
        $this->cvc = null;
        $this->cardNo = null;
        $this->phone = null;
        $this->returnUrl = null;
        $this->callbackUrl = null;
    }

    /**
     * @return mixed
     *          false: 連線失敗
     *          array: hitrust 回應
     * @throws \Exception
     */
    public function pay()
    {
        if (!$this->storeId) {
            throw new \Exception('請呼叫 storeId()', 422);
        }
        if (!$this->orderNumber) {
            throw new \Exception('請呼叫 orderNo()', 422);
        }
        if (!$this->amount) {
            throw new \Exception('請呼叫 money()', 422);
        }
        if (!$this->token) {
            throw new \Exception('請呼叫 token()', 422);
        }
        if (!$this->expiry) {
            throw new \Exception('請呼叫 expiry()', 422);
        }

        $params = [
            'storeId' => $this->storeId,
            'orderNumber' => $this->orderNumber,
            'amount' => $this->amount,
            'orderDesc' => '享樂支付',
            'depositFlag' => 1,
            'queryFlag' => 1,
            'trxToken' => $this->token,
            'expiry' => $this->expiry,
            'returnUrl' => $this->returnUrl,
            'callbackUrl' => $this->callbackUrl,
        ];

        $this->reset();
        return $this->hitrust->authTrxToken($params);
    }

    /**
     * @return mixed false: 連線失敗
     *               string: 接續網址
     * @throws \Exception
     */
    public function bindCard()
    {
        if (!$this->cardNo) {
            throw new \Exception('請呼叫 cardNo()', 422);
        }
        if (!$this->expiry) {
            throw new \Exception('請呼叫 expiry()', 422);
        }
        if (!$this->cvc) {
            throw new \Exception('請呼叫 cvc()', 422);
        }
        if (!$this->phone) {
            throw new \Exception('請呼叫 phone()', 422);
        }
        if (!$this->storeId) {
            $this->storeId(env('HITRUST_BIND_CARD_STORE_ID', 62493));
        }
        if (!$this->amount) {
            $this->money(1);
        }
        if (!$this->orderNumber) {
            $this->orderNo($this->phone.'J'.rand(11111, 99999));
        }

        $params = [
            'storeId' => $this->storeId,
            'orderNumber' => $this->orderNumber,
            'amount' => $this->amount,
            'orderDesc' => '綁定信用卡刷 1 塊',
            'depositFlag' => 0,
            'queryFlag' => 1,
            'cardNo' => $this->cardNo,
            'expiry' => $this->expiry,
            'cvc' => $this->cvc,
            'e55' => 1,
            'returnUrl' => $this->returnUrl,
            'callbackUrl' => $this->callbackUrl,
        ];

        $this->reset();
        return $this->hitrust->auth($params);
    }

    /**
     * @throws \Exception
     */
    public function authReverse()
    {
        if (!$this->orderNumber) {
            throw new \Exception('請呼叫 orderNo()', 422);
        }
        if (!$this->storeId) {
            $this->storeId(env('HITRUST_BIND_CARD_STORE_ID', 62493));
        }

        $params = [
            'storeId' => $this->storeId,
            'orderNumber' => $this->orderNumber,
            'queryFlag' => 1,
            'callbackUrl' => $this->callbackUrl,
        ];

        $this->reset();
        return $this->hitrust->authRe($params);
    }
}
