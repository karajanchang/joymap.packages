<?php

namespace Joymap\database\factories;

use Joymap\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Joymap\Models\Comment;
use Joymap\Models\Member;
use Joymap\Models\Order;

class OrderFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_no' => $this->faker->numberBetween(1, 999),
            'member_id' =>  function () {
                return Member::first()->id;
            },
            'name' => $this->faker->name,
            'gender' => $this->faker->numberBetween(0, 1),
            'email' => $this->faker->email,
            'store_id' =>  function () {
                return Store::first()->id;
            },
            'status' => $this->faker->numberBetween(0, 1),
            'adult_num' => $this->faker->numberBetween(0, 4),
            'child_num' => $this->faker->numberBetween(0, 4),
            'reservation_date' => $this->faker->date('Y-m-d'),
            'reservation_time' => $this->faker->time(),
            // 'goal_id' => ''
            'child_seat_num' => $this->faker->numberBetween(0, 2),
            'comment' => $this->faker->text(100),
            // 'amount' => $this->faker->text(100),
            // 'is_read' => $this->faker->text(100),
            // 'is_modify' => $this->faker->text(100),
            'from_source' => $this->faker->numberBetween(0, 1),
            // 'amount' => $this->faker->text(100),
            // 'amount' => $this->faker->text(100),
        ];
    }
}
