<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OffersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $this->faker = \Faker\Factory::create('fr_FR');

        return [
            'title' => $this->faker->jobTitle(),
            'postedBy' => User::all()->random()->id,
            'company' => $this->faker->company(),
            'location' => $this->faker->city(),
            'description' => $this->faker->realTextBetween(50,300, 2),
            'type' => rand(0, 3),
            'views' => rand(0, 500),
            'salary' => rand(20, 50) * 1000,
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
