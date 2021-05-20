<?php

namespace Database\Seeders;

use Joymap\Models\Store;
use Joymap\Models\StoreRole;
use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //StoreRole Factory建立時會自動建立一個Store
        StoreRole::factory()->count(1)->create();

        //建立4個 StoreRole 並且 store_id 使用 Store 第一筆資料的ID
        StoreRole::factory()->count(4)->create(['store_id' => Store::first()->id]);
    }
}
