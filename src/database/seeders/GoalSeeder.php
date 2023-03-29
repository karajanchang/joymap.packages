<?php

namespace Joymap\database\seeders;

use App\Models\Goal;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $goals = [
            ['name' => '朋友聚餐'],
            ['name' => '家庭聚會'],
            ['name' => '商務聚餐'],
            ['name' => '慶祝生日'],
            ['name' => '浪漫約會'],
            ['name' => '其他目的']
        ];

        foreach ($goals as $goal) {
            Goal::create($goal);
        }
    }
}
