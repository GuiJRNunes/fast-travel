<?php

namespace Database\Factories;

use App\Utilities\Unsplash;
use App\Enum\TourStatusEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_link' => Unsplash::generateRandomLink(),
            'title' => fake()->text(50),
            'description' => fake()->realText(500),
            'departure_date' => fake()->dateTimeInInterval('+1 days', '+60 days'),
            'return_date' => fake()->dateTimeInInterval('+61 days', '+121 days'),
            'capacity' => fake()->numberBetween(1, 50),
            'price_per_passenger' => fake()->randomFloat(2, 150, 600),
            'status' => TourStatusEnum::OPEN,
        ];
    }
}
