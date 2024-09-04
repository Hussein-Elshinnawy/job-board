<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobPost>
 */
class JobPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $CompanyIds = Company::pluck("id")->toArray();
        $CityIds = City::pluck("id")->toArray();
        return [
            'company_id' => fake()->randomElement($CompanyIds),
            'city_id' => fake()->randomElement($CityIds),
            'title' => fake()->sentence(5),
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'description' => fake()->paragraph(),
            'min_salary' => 1000.0,
            'max_salary' => 10000.0,
            'qualification' => fake()->paragraph(),
            'responsibilities' => fake()->paragraph(),
            'benefits' => fake()->paragraph(),
            'work_type' => fake()->randomElement(["onside", "remote", "hybrid", "freelance"]),
            'deadline' => fake()->dateTimeBetween('now', '+1 month'),
            'vacancies' => fake()->numberBetween(1, 20),
        ];
    }
}
