<?php

namespace Joymap\database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Joymap\Models\Payment;

class PaymentFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name . " Payment",
        ];
    }
}
