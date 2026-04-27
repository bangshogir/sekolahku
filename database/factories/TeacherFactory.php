<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    public function definition(): array
    {
        $positions = [
            'Kepala Madrasah',
            'Wakil Kepala Bidang Kurikulum',
            'Wakil Kepala Bidang Kesiswaan',
            'Wakil Kepala Bidang Humas',
            'Wakil Kepala Bidang Sarana',
            'Guru',
            'Guru BK',
            'Staf Tata Usaha',
        ];

        $subjects = [
            'Matematika', 'Bahasa Indonesia', 'Bahasa Arab', 'Bahasa Inggris',
            'IPA', 'IPS', 'Fiqih', 'Akidah Akhlak', 'Al-Quran Hadits',
            'SKI', 'PKN', 'Seni Budaya', 'Penjaskes', 'TIK',
        ];

        return [
            'nip'        => fake()->unique()->numerify('####################'),
            'name'       => fake()->name(),
            'position'   => fake()->randomElement($positions),
            'subject'    => fake()->randomElement($subjects),
            'photo'      => null,
            'bio'        => fake()->paragraph(2),
            'is_active'  => true,
            'sort_order' => fake()->numberBetween(1, 100),
        ];
    }
}
