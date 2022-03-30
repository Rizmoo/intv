<?php

namespace Database\Factories;

use App\Enums\Locations;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $states = new OrderStatus();
        $locations = new Locations();
        return [
            'order_number' => Str::random(8),
            'amount' => $this->faker->randomDigit(),
            'uuid' => $this->faker->uuid,
            'paid' => $this->faker->boolean(),
            'status' => $this->faker->randomElement($states->toArray()),
            'location' => $this->faker->randomElement($locations->toArray()),
        ];
    }
}
