<?php

namespace Database\Factories;

use App\Models\Creator;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->sentence,
            "description" => $this->faker->paragraph(1),
            "image" => $this->faker->imageUrl(),
            "creator_id" => User::inRandomOrder()->value('id')
            // "creator_id" => Creator::inRandomOrder()->value('id')
        ];
    }
}
