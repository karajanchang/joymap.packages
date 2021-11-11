<?php

namespace Joymap\Services\Payments;

use Joymap\Models\Store;

class Joypay
{
    private $service;
    private $token;
    private $amount;
    private $store;
    private $storeId;
    private $orderNumber;
    private $expiry;
    private $cvc;
    private $cardNo;
    private $phone;
    private $returnUrl = null;
    private $callbackUrl = null;
    private $email;

    /**
     * @throws \Exception
     */
    public function bySpgateway(): Joypay
    {
        $this->service = app(Spgateway::class);
        return $this;
    }

    public function byHitrustpay(): Joypay
    {
        $this->service = app(Hitrustpay::class);
        return $this;
    }

    public function storeId($storeId): Joypay
    {
        $this->storeId = $storeId;
        return $this;
    }

    public function store(Store $store): Joypay
    {
        $this->store = $store;
        $this->service->setStore($store);
        return $this;
    }

    public function token($token): Joypay
    {
        $this->token = $token;
        return $this;
    }

    public function money($amount): Joypay
    {
        $this->amount = $amount * $this->service->getAmountMultiplicand();
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

    public function email($email): Joypay
    {
        $this->email = $email;
        return $this;
    }

    private function reset()
    {
        $this->token = null;
        $this->amount = null;
        $this->storeId = null;
        $this->store = null;
        $this->orderNumber = null;
        $this->expiry = null;
        $this->cvc = null;
        $this->cardNo = null;
        $this->phone = null;
        $this->returnUrl = null;
        $this->callbackUrl = null;
        $this->email = null;
    }

    /**
     * @throws \Exception
     */
    public function pay()
    {
        if (!$this->store || !$this->storeId) {
            throw new \Exception('請呼叫 store() 或 storeId()', 422);
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
        if (($this->service instanceof Hitrustpay) && !$this->expiry) {
            throw new \Exception('請呼叫 expiry()', 422);
        }
        if (!$this->email) {
            throw new \Exception('請呼叫 email()', 422);
        }

        $params = [
            'storeId' => $this->storeId,
            'orderNumber' => $this->orderNumber,
            'amount' => $this->amount,
            'orderDesc' => '享樂支付',
            'depositFlag' => 1,
            'queryFlag' => 1,
            'token' => $this->token,
            'expiry' => $this->expiry,
            'returnUrl' => $this->returnUrl,
            'callbackUrl' => $this->callbackUrl,
        ];

        $this->reset();
        return $this->service->pay($params);
    }

    /**
     * @throws \Exception
     */
    public function bindCard()
    {
        if (!$this->store || !$this->storeId) {
            throw new \Exception('請呼叫 store() 或 storeId()', 422);
        }
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
        if (!$this->email) {
            throw new \Exception('請呼叫 email()', 422);
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
        return $this->service->bindCard($params);
    }

    /**
     * @throws \Exception
     */
    public function cancel()
    {
        if (!$this->orderNumber) {
            throw new \Exception('請呼叫 orderNo()', 422);
        }
        if (!$this->amount) {
            throw new \Exception('請呼叫 money()', 422);
        }
        if (!$this->store || !$this->storeId) {
            throw new \Exception('請呼叫 store() 或 storeId()', 422);
        }

        $params = [
            'storeId' => $this->storeId,
            'orderNumber' => $this->orderNumber,
            'amount' => $this->amount,
            'queryFlag' => 1,
            'callbackUrl' => $this->callbackUrl,
        ];

        $this->reset();
        return $this->service->cancel($params);
    }

    /**
     * @throws \Exception
     */
    public function query()
    {
        if (!$this->orderNumber) {
            throw new \Exception('請呼叫 orderNo()', 422);
        }
        if (!$this->amount) {
            throw new \Exception('請呼叫 money()', 422);
        }
        if (!$this->store || !$this->storeId) {
            throw new \Exception('請呼叫 store() 或 storeId()', 422);
        }

        $params = [
            'storeId' => $this->storeId,
            'orderNumber' => $this->orderNumber,
            'amount' => $this->amount,
        ];

        $this->reset();
        return $this->service->query($params);
    }
}
