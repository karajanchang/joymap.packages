<?php

namespace Joymap\database\factories;

use Joymap\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Joymap\Models\Comment;
use Joymap\Models\Member;
use Joymap\Models\Order;

class CommentFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'member_id' => function () {
                return Member::factory()->create()->id;
            },
            'name' => $this->faker->name,
            'title' => $this->faker->text(10),
            'body' => $this->faker->text(100),
            'order_id' => function () {
                return Order::factory()->create()->id;
            },
            'store_id' => function () {
                return Store::first()->id;
            },
            'score' => $this->faker->numberBetween(1, 5),
            'is_replied' => $this->faker->numberBetween(0, 1)
        ];
    }
}
