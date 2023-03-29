<?php

namespace Joymap\database\seeders;

use App\Models\StoreRestriction;
use Illuminate\Database\Seeder;

class StoreRestrictionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $storeRestrictions = [
            [
                'name' => '1小時',
                'limit_minute' => 60
            ],
            [
                'name' => '1.5小時',
                'limit_minute' => 90
            ],
            [
                'name' => '2小時',
                'limit_minute' => 120
            ],
            [
                'name' => '2.5小時',
                'limit_minute' => 150
            ],
            [
                'name' => '3小時',
                'limit_minute' => 180
            ],
            [
                'name' => '3.5小時',
                'limit_minute' => 210
            ]
        ];

        foreach ($storeRestrictions as $storeRestriction) {
            StoreRestriction::create($storeRestriction);
        }
    }
}
