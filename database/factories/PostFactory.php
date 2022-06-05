<?php

namespace Database\Factories;

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
    public function definition()
    {
        // get ID of users
        $userIds = User::all()->pluck('id')->toArray();
        return [
            'title' => $this->faker->sentence(6),
            'author' => $this->faker->randomElement($userIds),
            'slug' => $this->faker->slug,
            'body' => $this->faker->paragraph(50),
            'image' => $this->faker->imageUrl,
        ];
    }
}
