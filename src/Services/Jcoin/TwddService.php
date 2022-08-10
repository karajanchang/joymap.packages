<?php

namespace Joymap\Services\Jcoin;

class TwddService extends BaseJcoinService implements Jcoin{

    public function __construct()
    {
        $this->baseUrl = env('TWDD_JCOIN_URL', 'https://jcoin-test.joymap.tw');
        $this->jUser = env('TWDD_JCOIN_USER', 'dHdkZEB0d2RkLmNvbS50dw==');
        $this->jPw = env('TWDD_JCOIN_PW', 'QmVzdEpveW1hcCFAIyQ=');
    }
}