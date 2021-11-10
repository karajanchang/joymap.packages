<?php

namespace Joymap\Services\Payments;

use Joymap\Models\Store;

interface pay
{
    public function getAmountMultiplicand(): int;
    public function setStore(Store $store);
    public function bindCard(array $params);
    public function pay(array $params);
    public function cancel(array $params);
}
