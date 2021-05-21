<?php

namespace Joymap\database\factories;

use Joymap\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Joymap\Models\SpecialStoreBusinessTime;

class SpecialStoreBusinessTimeFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpecialStoreBusinessTime::class;

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
            'special_date' => $this->faker->date(),
            'week' => $this->faker->numberBetween(0, 6),
            'begin_time' => $this->faker->time(),
            'end_time' => $this->faker->time(),
            'is_open' => $this->faker->numberBetween(0, 1)
        ];
    }
}
