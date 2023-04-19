<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;

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
           // 'user_id' => User::factory()->create(),
          //  'user_id' => $factory->create(\App\User::class)->id,
            'title' => fake()->title(),
            'post_image' => fake()->imageUrl(900, 300),
            'body' => fake()->paragraph()
        ];
    }
}
