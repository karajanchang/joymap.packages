<?php

namespace Joymap\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Joymap\Models\Order;
use Joymap\Models\OrderTimeLog;

class OrderTimeLogFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderTimeLog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => function () {
                return Order::first()->id;
            },
            'order_time' => $this->faker->date('Y-m-d H:i:s'),
            'store_order_time' => $this->faker->date('Y-m-d H:i:s'),
            'cancel_time' => $this->faker->date('Y-m-d H:i:s'),
            'store_cancel_time' => $this->faker->date('Y-m-d H:i:s'),
            'seat_time' => $this->faker->date('Y-m-d H:i:s'),
            'seat_hold_time' => $this->faker->date('Y-m-d H:i:s'),
            'bill_time' => $this->faker->date('Y-m-d H:i:s'),
            'no_show_time' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
