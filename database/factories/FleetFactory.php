<?php

namespace Database\Factories;

use App\Enums\FleetStates;
use App\Enums\Locations;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fleet>
 */
class FleetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $states = new FleetStates();
        $locations = new Locations();
        return [
            'vehicle_reg' => Str::random(6),
            'uuid' => $this->faker->uuid,
            'state' => $this->faker->randomElement($states->toArray()),
            'location' => $this->faker->randomElement($locations->toArray()),
        ];
    }
}
