<?php

namespace Joymap\database\seeders;

use Illuminate\Database\Seeder;
use Joymap\Models\StorePermission;

class StorePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'id' => 1,
                'name' => '訂位功能',
                'sort' => 1
            ],
            [
                'id' => 2,
                'name' => '歷史紀錄',
                'sort' => 2
            ],
            [
                'id' => 3,
                'name' => '訂位紀錄',
                'sort' => 3,
                'parent_id' => 2
            ],
            [
                'id' => 4,
                'name' => '回饋金紀錄',
                'sort' => 4,
                'parent_id' => 2
            ],
            [
                'id' => 5,
                'name' => '設定',
                'sort' => 5,
            ],
            [
                'id' => 6,
                'name' => '店家資訊',
                'sort' => 6,
                'parent_id' => 5
            ],
            [
                'id' => 7,
                'name' => '營業時間設定',
                'sort' => 7,
                'parent_id' => 5
            ],
            [
                'id' => 8,
                'name' => '照片管理',
                'sort' => 8,
                'parent_id' => 5
            ],
            [
                'id' => 9,
                'name' => '訂位設定',
                'sort' => 9,
                'parent_id' => 5
            ],
            [
                'id' => 10,
                'name' => '權限控管',
                'sort' => 10,
                'parent_id' => 5
            ],
            [
                'id' => 11,
                'name' => '標籤管理',
                'sort' => 11,
                'parent_id' => 5
            ],
            [
                'id' => 12,
                'name' => '動態訊息',
                'sort' => 12,
            ],
            [
                'id' => 13,
                'name' => '官方公告',
                'sort' => 13,
                'parent_id' => 12
            ],
            [
                'id' => 14,
                'name' => '餐廳評論',
                'sort' => 14,
                'parent_id' => 12
            ],
        ];

        foreach ($datas as $key => $value) {
            StorePermission::create($value);
        }
    }
}
