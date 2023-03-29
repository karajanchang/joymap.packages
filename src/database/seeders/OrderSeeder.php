<?php

namespace Joymap\database\seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Faker;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($x = 1; $x < 201; $x++) {
            $order = Order::create([
                "order_no" => "OD-$x",
                "member_id" => rand(1, 99),
                "name" => "ON-$x",
                "gender" => rand(0, 1),
                "email" => $faker->email(),
                "store_id" => rand(1, 99),
                "status" => rand(0, 7),
                "adult_num" => rand(0, 4),
                "child_num" => rand(0, 4),
                "reservation_date" => $faker->date("Y-m-d"),
                "reservation_time" =>  $faker->date("H:i:s"),
                "goal_id" => rand(1, 10),
                "child_seat_num" => 0,
                "comment" => "訂單備註$x",
                "amount" => rand(100, 10000),
                "is_read" => rand(0, 1),
                "is_modify" => rand(0, 1),
                "from_source" => rand(0, 3),
                "created_at" => $faker->date("Y-m-d H:i:s"),
                "updated_at" => $faker->date("Y-m-d H:i:s")
            ]);

            $order->timeLogs()->create([
                "order_time" => $faker->date("Y-m-d H:i:s"),
                "store_order_time" => $faker->date("Y-m-d H:i:s"),
                "cancel_time" => $faker->date("Y-m-d H:i:s"),
                "store_cancel_time" => $faker->date("Y-m-d H:i:s"),
                "seat_time" => $faker->date("Y-m-d H:i:s"),
                "system_seat_time" => $faker->date("Y-m-d H:i:s"),
                "seat_hold_time" => $faker->date("Y-m-d H:i:s"),
                "bill_time" => $faker->date("Y-m-d H:i:s"),
                "system_bill_time" => $faker->date("Y-m-d H:i:s"),
                "no_show_time" => $faker->date("Y-m-d H:i:s"),
            ]);
        }
    }
}
