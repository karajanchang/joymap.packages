<?php

namespace Joymap\database\seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            '精英級',
            '大師級',
            '鑽石級',
            '白金級',
            '黃金級'
        ];
        foreach ($levels as $name) {
            Level::create(['name' => $name]);
        }
    }
}
