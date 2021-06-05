<?php

namespace Joymap\database\seeders;

use Illuminate\Database\Seeder;
use Joymap\Models\City;

class CityDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = \file_get_contents(__DIR__.'/../../storage/tw_city_district.json',true);
        $ctx = json_decode($file,true);

        foreach ($ctx as $key => $value) {
            $city = City::create([
                'name' => $key
            ]);

            foreach ($value as $districtName) {
                $city->districts()->create([
                    'name' => $districtName
                ]);
            }
        }
    }
}
