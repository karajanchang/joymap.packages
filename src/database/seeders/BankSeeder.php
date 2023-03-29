<?php

namespace Joymap\database\seeders;

use App\Models\Bank;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            [
                'code' => '004',
                'name' => '臺灣銀行'
            ],
            [
                'code' => '005',
                'name' => '臺灣土地銀行'
            ],
            [
                'code' => '006',
                'name' => '合作金庫商業銀行'
            ],
            [
                'code' => '007',
                'name' => '第一商業銀行'
            ],
            [
                'code' => '008',
                'name' => '華南商業銀行'
            ],
            [
                'code' => '009',
                'name' => '彰化商業銀行'
            ],
            [
                'code' => '011',
                'name' => '上海商業儲蓄銀行'
            ],
            [
                'code' => '012',
                'name' => '台北富邦商業銀行'
            ],
            [
                'code' => '013',
                'name' => '國泰世華商業銀行'
            ],
            [
                'code' => '016',
                'name' => '高雄銀行'
            ],
            [
                'code' => '017',
                'name' => '兆豐國際商業銀行'
            ],
            [
                'code' => '018',
                'name' => '全國農業金庫'
            ],
            [
                'code' => '021',
                'name' => '花旗(台灣)商業銀行'
            ],
            [
                'code' => '048',
                'name' => '王道商業銀行'
            ],
            [
                'code' => '050',
                'name' => '臺灣中小企業銀行'
            ],
            [
                'code' => '052',
                'name' => '渣打國際商業銀行'
            ],
            [
                'code' => '053',
                'name' => '台中商業銀行'
            ],
            [
                'code' => '054',
                'name' => '京城商業銀行'
            ],
            [
                'code' => '075',
                'name' => '香港商東亞銀行台北分行'
            ],
            [
                'code' => '081',
                'name' => '滙豐(台灣)商業銀行'
            ],
            [
                'code' => '101',
                'name' => '瑞興商業銀行'
            ],
            [
                'code' => '102',
                'name' => '華泰商業銀行'
            ],
            [
                'code' => '103',
                'name' => '臺灣新光商業銀行'
            ],
            [
                'code' => '108',
                'name' => '陽信商業銀行'
            ],
            [
                'code' => '118',
                'name' => '板信商業銀行'
            ],
            [
                'code' => '147',
                'name' => '三信商業銀行'
            ],
            [
                'code' => '803',
                'name' => '聯邦商業銀行'
            ],
            [
                'code' => '805',
                'name' => '遠東國際商業銀行'
            ],
            [
                'code' => '806',
                'name' => '元大商業銀行'
            ],
            [
                'code' => '807',
                'name' => '永豐商業銀行'
            ],
            [
                'code' => '808',
                'name' => '玉山商業銀行'
            ],
            [
                'code' => '809',
                'name' => '凱基商業銀行'
            ],
            [
                'code' => '810',
                'name' => '星展(台灣)商業銀行'
            ],
            [
                'code' => '812',
                'name' => '台新國際商業銀行'
            ],
            [
                'code' => '815',
                'name' => '日盛國際商業銀行'
            ],
            [
                'code' => '816',
                'name' => '安泰商業銀行'
            ],
            [
                'code' => '822',
                'name' => '中國信託商業銀行'
            ],
            [
                'code' => '823',
                'name' => '將來商業銀行'
            ],
            [
                'code' => '824',
                'name' => '連線商業銀行'
            ],
            [
                'code' => '826',
                'name' => '樂天國際商業銀行'
            ],
            [
                'code' => '700',
                'name' => '中華郵政公司'
            ]
        ];

        foreach ($banks as $bank) {
            Bank::create($bank);
        }
    }
}
