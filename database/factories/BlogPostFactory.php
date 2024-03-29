<?php

namespace Database\Factories;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph(30),
            'user_id' => User::inRandomOrder()->first()->id,
            'title_fr' => $this->faker->sentence,
            'body_fr' => $this->faker->paragraph(30),
            'categories_id' => $this->faker->numberBetween(1, 2)
        ];
    }
}
