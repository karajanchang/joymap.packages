<?php

namespace Joymap\Services\Jcoin;

class JoymapService extends BaseJcoinService implements Jcoin{

    public function __construct()
    {
        $this->baseUrl = env('JCOIN_URL', 'https://jcoin-test.joymap.tw');
        $this->jUser = env('JCOIN_USER', 'am95bWFwQGpveW1hcC50dw==');
        $this->jPw = env('JCOIN_PW', 'QmVzdEpveW1hcCFAIyQ=');
    }
}