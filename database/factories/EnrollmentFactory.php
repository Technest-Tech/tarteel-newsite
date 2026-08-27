<?php

namespace Database\Factories;

use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enrollment>
 */
class EnrollmentFactory extends Factory
{
    protected $model = Enrollment::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => '+20'.fake()->numerify('##########'),
            'country' => fake()->country(),
            'student_type' => fake()->randomElement(['child', 'adult']),
            'age' => fake()->numberBetween(5, 60),
            'program' => fake()->randomElement(['quran', 'tajweed', 'memorization', 'arabic']),
            'preferred_language' => fake()->randomElement(['arabic', 'english', 'both']),
            'availability' => 'Weekday evenings',
            'message' => fake()->sentence(),
            'status' => 'new',
            'source_locale' => fake()->randomElement(['ar', 'en']),
        ];
    }
}
