<?php

namespace Joymap\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Joymap\Models\StoreRestriction;

class StoreRestrictionFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreRestriction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->numerify('Restriction ##'),
            'limit_minute' => $this->faker->randomElement([
                0, 30, 60, 90, 120, 150
            ]),
        ];
    }
}
