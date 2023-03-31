<?php

namespace Joymap\database\seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\CommentScore;
use App\Models\CommentScoreSetting;
use Faker;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $orders = Order::where('status', 6)->get();

        $commentScoreSettings = CommentScoreSetting::all();

        foreach ($orders as $key => $order) {
            //評論主體
            $comment = Comment::create([
                "member_id" => $order->member_id,
                "name" => '評論-' . $order->store->name,
                "title" =>  $order->store->name . '的菜真是太難吃了',
                "body" => '這是' . $order->id . '評論的內容',
                "order_id" => $order->id,
                "store_id" => $order->store_id,
                "score" => rand(1, 5),
                "is_replied" => rand(0, 1),
                "created_at" => $faker->date("Y-m-d H:i:s"),
                "updated_at" => $faker->date("Y-m-d H:i:s"),
            ]);

            // 評論各項目分數
            foreach ($commentScoreSettings as $sett) {
                CommentScore::create([
                    "comment_id" => $comment->id,
                    "comment_score_setting_id" => $sett->id,
                    "score" => rand(1, 5)
                ]);
            }

            //決定要不要有評論照片
            $hasImage = rand(0, 1);

            if ($hasImage == 1) {
                //照片數量
                $imageCount = rand(1, 8);

                for ($x = 0; $x < $imageCount; $x++) {
                    $comment->images()->create([
                        'url' => $faker->imageUrl(),
                        "created_at" => $faker->date("Y-m-d H:i:s"),
                        "updated_at" => $faker->date("Y-m-d H:i:s"),
                    ]);
                }
            }
        }
    }
}
