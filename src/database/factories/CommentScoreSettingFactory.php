<?php

namespace Joymap\database\factories;

use Joymap\Models\CommentScoreSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentScoreSettingFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommentScoreSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
