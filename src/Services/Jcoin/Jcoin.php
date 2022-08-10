<?php

namespace Joymap\Services\Jcoin;

interface Jcoin {
    
    /**
     * 儲值J幣
     *
     * @return void
     */
    public function add(array $data);
        
    /**
     * 儲值分潤
     *
     * @return void
     */
    public function addBonus(array $data);    

    /**
     * 建立J幣帳戶
     *
     * @return void
     */
    public function createUser(string $phone, string $name);
    
    /**
     * 取得J幣使用紀錄
     *
     * @return void
     */
    public function coinLogs(array $data);

    /**
     * 取得用戶J幣帳戶資料
     *
     * @return void
     */
    public function getUserInfo(string $phone);
    
    /**
     * 消耗J幣
     *
     * @return void
     */
    public function sub(array $data);
    
    /**
     * 提領
     *
     * @return void
     */
    public function subBonus(array $data);
}