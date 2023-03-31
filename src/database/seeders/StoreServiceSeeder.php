<?php

namespace Joymap\database\seeders;

use App\Models\StoreService;
use Illuminate\Database\Seeder;

class StoreServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storeServices = [
            ['name' => '附近有停車位'],
            ['name' => '素食友善'],
            ['name' => '免費wi-fi'],
            ['name' => '服務費'],
            ['name' => '代駕服務'],
            ['name' => '吸菸區'],
            ['name' => '有包廂/適合大型聚會'],
            ['name' => '酒精飲品'],
            ['name' => '適合孩童'],
            ['name' => '戶外座位區'],
            ['name' => '慶生支援'],
            ['name' => '寵物友善']
        ];

        foreach ($storeServices as $storeService) {
            StoreService::create($storeService);
        }
    }
}
