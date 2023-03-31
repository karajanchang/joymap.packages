<?php

namespace Joymap\database\seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ar = [
            '享樂幣30%', '會員暢飲99', '今天免費'
        ];

        foreach ($ar as $key => $value) {
            Tag::create([
                'title' => $value
            ]);
        }
    }
}
