<?php

namespace Joymap\database\factories;

use Joymap\Models\StoreUser;
use Joymap\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class StoreUserFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StoreUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account' => $this->faker->realText(10),
            'password' => Hash::make($this->faker->numberBetween(1000, 100000)),
            'email' => $this->faker->email,
            'name' => $this->faker->name,
            'store_id' => function () {
                return Store::factory()->create()->id;
            },
        ];
    }
}
