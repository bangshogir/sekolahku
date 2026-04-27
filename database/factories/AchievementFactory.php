<?php

namespace Database\Factories;

use App\Models\Achievement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AchievementFactory extends Factory
{
    public function definition(): array
    {
        $competitions = [
            'Olimpiade Matematika', 'Lomba Tahfidz Quran', 'Lomba Kaligrafi',
            'MTQ (Musabaqah Tilawatil Quran)', 'Lomba Pidato Bahasa Arab',
            'Lomba Pidato Bahasa Inggris', 'Olimpiade IPA', 'Lomba Pramuka',
            'Lomba Futsal Pelajar', 'Lomba Hadroh', 'Lomba Qasidah',
            'Lomba Karya Ilmiah Remaja', 'Olimpiade Bahasa Indonesia',
        ];

        return [
            'name'             => 'Juara ' . fake()->randomElement(['1', '2', '3', 'Harapan 1', 'Harapan 2']),
            'competition_type' => fake()->randomElement($competitions),
            'level'            => fake()->randomElement(array_keys(Achievement::LEVELS)),
            'year'             => fake()->numberBetween(2020, 2025),
            'certificate_photo' => null,
            'description'      => fake()->paragraph(1),
        ];
    }
}
