<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $posts = \App\Models\Post::all()->pluck('id')->toArray();
        $userIds = \App\Models\User::all()->pluck('id')->toArray();
        $userEmail = \App\Models\User::all()->pluck('email')->toArray();
        return [
            'author' => $this->faker->randomElement($userIds),
            'email' => $this->faker->randomElement($userEmail),
            'body' => $this->faker->paragraph(10),
            'post_id' => $this->faker->randomElement($posts),
        ];
    }
}
