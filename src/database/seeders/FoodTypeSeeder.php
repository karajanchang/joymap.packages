<?php

namespace Joymap\database\seeders;

use App\Models\MainFoodType;
use Illuminate\Database\Seeder;

class FoodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = \file_get_contents(__DIR__ . '/../../storage/foodtype.json', true);
        $ctx = json_decode($file, true);

        foreach ($ctx as $main => $subs) {
            $main = MainFoodType::create([
                'name' => $main
            ]);
            foreach ($subs as $key => $sub) {
                $main->foodTypes()->create([
                    'name' => $sub
                ]);
            }
        }
    }
}
