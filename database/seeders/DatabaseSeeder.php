<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();


        User::factory(10)->create()
            ->each(function ($user) {
                Post::create([
                    'user_id' => $user->id,
                    'title' => fake()->sentence(),
                    'post_image' => fake()->imageUrl(900, 300),
                    'body' => fake()->paragraph()
                ]);

            });

        // \App\Models\Post::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
