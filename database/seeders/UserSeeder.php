<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->has(Profile::factory()->state([
                'age' => 25,
                'bio' => 'I am a software developer who loves hiking and traveling.',
                'gender' => 'male',
                'looking_for_gender' => 'female',
                'location' => 'New York',
            ]))
            ->create([
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => bcrypt('password'), 
            ]);

        User::factory(20)
            ->has(Profile::factory())
            ->create();
    }
}
