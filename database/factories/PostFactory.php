<?php

namespace Database\Factories;

use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Model>
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
            "uuid" => $this->faker->uuid(),
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraph(),
            'user_id' => 1, 
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
