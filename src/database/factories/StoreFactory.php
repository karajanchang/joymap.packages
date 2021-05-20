<?php

namespace Joymap\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Joymap\Models\Store;

class StoreFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Store::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store_no' => $this->faker->numberBetween(1000, 100000),
            'store_code' => $this->faker->numberBetween(1000, 100000),
            'slug' => $this->faker->randomLetter,
            'name' => $this->faker->name,
            'city_id' => $this->faker->numberBetween(1, 10),
            'district_id' => $this->faker->numberBetween(1, 10),
            'address' => $this->faker->address,
            // 'phone' => $this->faker->phone,
            'status' => 1,
        ];
    }
}
