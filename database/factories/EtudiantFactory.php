<?php

namespace Database\Factories;
use App\Models\Ville;

use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        return [
            'adress' => $this->faker->streetAddress,
            'phone'=> $this->faker->unique()->phoneNumber,
            'birthdate'=> $this->faker->date($format = 'Y-m-d', $max = '2004-01-01'),
            'userId'=> $this->faker->unique()->numberBetween(1, 100),
            'villeId'=> Ville::inRandomOrder()->first()->id,
        ];
    }
}
