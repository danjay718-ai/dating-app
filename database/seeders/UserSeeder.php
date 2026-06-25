<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile; 
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $john = User::query()->updateOrCreate(
            ['email' => 'john.doe@example.com'],
            [
                'name' => 'John Doe',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ],
        );

        Profile::query()->updateOrCreate(
            ['user_id' => $john->id],
            [
                'age' => 25,
                'bio' => 'I am a software developer who loves hiking and traveling.',
                'gender' => 'male',
                'looking_for_gender' => 'female',
                'location' => 'New York',
            ],
        );

        $profiles = [
            ['name' => 'Maya Santos', 'email' => 'maya.santos@example.com', 'age' => 27, 'gender' => 'female', 'looking_for_gender' => 'male', 'location' => 'Makati', 'bio' => 'Designer who likes gallery walks, quiet coffee shops, and finding the best ramen in the city.'],
            ['name' => 'Sofia Reyes', 'email' => 'sofia.reyes@example.com', 'age' => 29, 'gender' => 'female', 'looking_for_gender' => 'male', 'location' => 'BGC', 'bio' => 'Weekend baker, morning runner, and always planning the next beach trip.'],
            ['name' => 'Isabella Cruz', 'email' => 'isabella.cruz@example.com', 'age' => 26, 'gender' => 'female', 'looking_for_gender' => 'male', 'location' => 'Quezon City', 'bio' => 'Bookstore dates, old films, and long conversations over dessert are my kind of evening.'],
            ['name' => 'Camille Navarro', 'email' => 'camille.navarro@example.com', 'age' => 31, 'gender' => 'female', 'looking_for_gender' => 'male', 'location' => 'Pasig', 'bio' => 'Product manager who loves weekend markets, live music, and people who are kind to servers.'],
            ['name' => 'Nina Villanueva', 'email' => 'nina.villanueva@example.com', 'age' => 28, 'gender' => 'female', 'looking_for_gender' => 'male', 'location' => 'Taguig', 'bio' => 'Pilates, spicy food, and spontaneous road trips. Looking for someone easy to laugh with.'],
            ['name' => 'Ally Garcia', 'email' => 'ally.garcia@example.com', 'age' => 30, 'gender' => 'female', 'looking_for_gender' => 'male', 'location' => 'Mandaluyong', 'bio' => 'Marketing lead, plant parent, and serious about finding the city’s best croissant.'],
            ['name' => 'Bea Mendoza', 'email' => 'bea.mendoza@example.com', 'age' => 24, 'gender' => 'female', 'looking_for_gender' => 'male', 'location' => 'San Juan', 'bio' => 'New to the city and looking for someone to explore cafes, museums, and night markets with.'],
            ['name' => 'Clara Lim', 'email' => 'clara.lim@example.com', 'age' => 33, 'gender' => 'female', 'looking_for_gender' => 'male', 'location' => 'Alabang', 'bio' => 'Lawyer by weekday, home cook by weekend. I like calm people and good stories.'],
            ['name' => 'Dani Chua', 'email' => 'dani.chua@example.com', 'age' => 27, 'gender' => 'female', 'looking_for_gender' => 'male', 'location' => 'Manila', 'bio' => 'Music, photography, and slow Sundays. Bonus points if you have a favorite local band.'],
            ['name' => 'Ella Ramos', 'email' => 'ella.ramos@example.com', 'age' => 32, 'gender' => 'female', 'looking_for_gender' => 'male', 'location' => 'Paranaque', 'bio' => 'I like honest conversations, good sushi, and trips that start with no strict itinerary.'],
            ['name' => 'Julia Tan', 'email' => 'julia.tan@example.com', 'age' => 25, 'gender' => 'female', 'looking_for_gender' => 'male', 'location' => 'Pasay', 'bio' => 'Fitness coach who loves dogs, sunsets, and trying one new restaurant every week.'],
            ['name' => 'Lara Aquino', 'email' => 'lara.aquino@example.com', 'age' => 29, 'gender' => 'female', 'looking_for_gender' => 'male', 'location' => 'Marikina', 'bio' => 'Creative writer, coffee loyalist, and fan of people who can communicate clearly.'],
            ['name' => 'Miguel Torres', 'email' => 'miguel.torres@example.com', 'age' => 30, 'gender' => 'male', 'looking_for_gender' => 'female', 'location' => 'Makati', 'bio' => 'Engineer who cooks on weekends and likes hiking trails more than malls.'],
            ['name' => 'Paolo Rivera', 'email' => 'paolo.rivera@example.com', 'age' => 28, 'gender' => 'male', 'looking_for_gender' => 'female', 'location' => 'BGC', 'bio' => 'Cycling, jazz playlists, and finding quiet corners in busy places.'],
            ['name' => 'Sam Lee', 'email' => 'sam.lee@example.com', 'age' => 26, 'gender' => 'non-binary', 'looking_for_gender' => 'non-binary', 'location' => 'Quezon City', 'bio' => 'Illustrator who loves thrift shops, noodles, and people with gentle energy.'],
        ];

        foreach ($profiles as $profileData) {
            $user = User::query()->updateOrCreate(
                ['email' => $profileData['email']],
                [
                    'name' => $profileData['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ],
            );

            Profile::query()->updateOrCreate(
                ['user_id' => $user->id],
                [
                    'age' => $profileData['age'],
                    'bio' => $profileData['bio'],
                    'gender' => $profileData['gender'],
                    'looking_for_gender' => $profileData['looking_for_gender'],
                    'location' => $profileData['location'],
                ],
            );
        }
    }
}
