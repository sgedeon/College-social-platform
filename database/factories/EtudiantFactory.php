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
            'nom' => $this->faker->name(),
            'adresse' => $this->faker->streetAddress,
            'phone'=> $this->faker->unique()->phoneNumber,
            'email' => $this->faker->unique()->safeEmail,
            'date_de_naissance'=> $this->faker->date($format = 'Y-m-d', $max = '2004-01-01'),
            'villeId'=>Ville::inRandomOrder()->first()->id,
        ];
    }
}
