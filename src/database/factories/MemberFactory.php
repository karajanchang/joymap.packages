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
            'is_change_name' => $this->faker->numberBetween(0, 1),
            'email' => $this->faker->unique()->safeEmail,
            'phone_prefix' => '080',
            'phone' => '09'.$this->faker->numerify('########'),
            'gender' => $this->faker->numberBetween(0, 1),
            'member_no' => 'J-' . $this->faker->numerify('######'),
            'is_active' => $this->faker->numberBetween(0, 1),
            'from_source' => $this->faker->numberBetween(0, 3),
            // "password",
            // "pay_password",
            "nick_name" => $this->faker->name,
            "is_nick_name_show" => $this->faker->numberBetween(0, 1),
            // "city_id" ,
            // "district_id",
            // "address",
            "is_change_gender" => $this->faker->numberBetween(0, 1),
            "avatar" => $this->faker->imageUrl(),
            "is_email_active" => $this->faker->numberBetween(0, 1),
            "status" => $this->faker->numberBetween(0, 1),
            "birthday" => $this->faker->date('Y-m-d'),
            // "summary",
            "is_change_birthday" => $this->faker->numberBetween(0, 1),
            // "tax_number",
            // "level_id",
            // "register_device",
            "invite_code" => $this->faker->numerify('######'),
            // "from_invite_id",
            // "coin_token",
            // "coin_user_id",
            // "facebook_id",
            // "google_id",
            // "apple_id",
            // "created_at",
            // "updated_at"
        ];
    }
}
