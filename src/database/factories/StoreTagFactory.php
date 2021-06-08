<?php

namespace Joymap\database\factories;

use Joymap\Models\Store;
use Joymap\Models\StoreTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreTagFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreTag::class;

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
            'name' => $this->faker->name,
            'type' => $this->faker->numberBetween(0, 1),
            'color_code' => $this->faker->hexcolor,
            'sort' => $this->faker->numberBetween(0, 10)
        ];
    }
}
