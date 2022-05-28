<?php

namespace Database\Factories;

use App\Models\Company;
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
        $company = Company::all()->random();

        return [
            'title' => $this->faker->jobTitle(),
            'postedBy' => $company->id,
            'company' => $company->name,
            'location' => $this->faker->city(),
            'description' => $this->faker->realTextBetween(50,300, 2),
            'type' => rand(0, 3),
            'views' => rand(0, 500),
            'salary' => rand(20, 50) * 1000,
        ];
    }
}
