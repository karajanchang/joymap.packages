<?php

namespace Joymap\database\factories;

use Joymap\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Joymap\Models\StoreImage;

class StoreImageFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreImage::class;

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
            'type' => $this->faker->numberBetween(0, 3),
            'url' => $this->faker->imageUrl(),
            'sort' => $this->faker->numberBetween(0, 100)
        ];
    }
}
