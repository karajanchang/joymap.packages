<?php

namespace Database\Factories;

use Joymap\Models\StoreRole;
use Joymap\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreRoleFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreRole::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'store_id' => function () {
                return Store::factory()->create()->id;
            },
            'is_active' => 1
        ];
    }
}
