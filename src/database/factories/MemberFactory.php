<?php

namespace Joymap\database\factories;

use Joymap\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Joymap\Models\Comment;
use Joymap\Models\Member;

class MemberFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Member::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'nick_name' => $this->faker->name,
            'phone_prefix' => $this->faker->numberBetween(1, 999),
            'phone' => '0987123456',
            'email' => $this->faker->email,
            'gender' => $this->faker->numberBetween(0, 1),
            'member_no' => $this->faker->numberBetween(100, 999),
            'avatar' => $this->faker->imageUrl(),
            'is_active' => $this->faker->numberBetween(0, 1),
            'status' => $this->faker->numberBetween(0, 1),
            'birthday' => $this->faker->date('Y-m-d'),
            'tax_number' => $this->faker->numberBetween(100, 999),
            'from_source' => $this->faker->numberBetween(0, 1),
        ];
    }
}
