<?php

namespace Joymap\database\factories;

use Joymap\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Joymap\Models\OrderSetting;

class OrderSettingFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store_id' => function () {
                return Store::first()->id;
            },
            'order_unit_minute' => $this->faker->randomElement([0, 15, 30]),
            'can_order_day' => $this->faker->numberBetween(0, 3),
            'same_time_order_total' => $this->faker->numberBetween(0, 3),
            'single_time_order_total' => $this->faker->numberBetween(0, 3),
            'final_order_minute' => $this->faker->randomElement([0, 15, 30]),
            'final_cancel_minute' => $this->faker->randomElement([0, 15, 30]),
        ];
    }
}
