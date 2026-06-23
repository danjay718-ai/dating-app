<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<User>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $genders = ['male', 'female', 'non-binary'];

            return [
                // If we create a profile without specifying a user, it will create one automatically
                'user_id' => User::factory(),
                'age' => fake()->numberBetween(18, 55),
                'bio' => fake()->realText(150), // Generates a random paragraph
                'gender' => fake()->randomElement($genders),
                'looking_for_gender' => fake()->randomElement($genders),
                'location' => fake()->city(),
            ];
    }
}
