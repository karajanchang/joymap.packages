<?php

namespace Joymap\database\seeders;

use App\Models\CommentScoreSetting;
use Illuminate\Database\Seeder;

class CommentScoreSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = ['食材新鮮度', 'CP值', '服務品質', '環境氣氛'];

        foreach ($names as $name) {
            CommentScoreSetting::create([
                'name' => $name
            ]);
        }
    }
}
