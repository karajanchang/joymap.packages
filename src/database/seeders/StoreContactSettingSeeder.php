<?php

namespace Joymap\database\seeders;

use App\Models\StoreContactSetting;
use Illuminate\Database\Seeder;

class StoreContactSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storeContactSetting = [
            ['name' => '系統相關'],
            ['name' => '操作相關'],
            ['name' => '改善建議'],
            ['name' => '其他問題']
        ];

        foreach ($storeContactSetting as $contactSetting) {
            StoreContactSetting::create($contactSetting);
        }
    }
}
