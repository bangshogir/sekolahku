<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ExtracurricularFactory extends Factory
{
    public function definition(): array
    {
        $ekskuls = [
            ['name' => 'Pramuka',       'supervisor' => 'Kak ' . fake()->name(), 'schedule' => 'Jum\'at, 14.00 - 16.00'],
            ['name' => 'PMR',           'supervisor' => fake()->name(),           'schedule' => 'Sabtu, 08.00 - 10.00'],
            ['name' => 'Rohis',         'supervisor' => fake()->name(),           'schedule' => 'Jum\'at, 13.00 - 15.00'],
            ['name' => 'Seni Kaligrafi','supervisor' => fake()->name(),           'schedule' => 'Sabtu, 10.00 - 12.00'],
            ['name' => 'Futsal',        'supervisor' => fake()->name(),           'schedule' => 'Rabu, 15.00 - 17.00'],
            ['name' => 'Qasidah',       'supervisor' => fake()->name(),           'schedule' => 'Kamis, 14.00 - 16.00'],
            ['name' => 'English Club',  'supervisor' => fake()->name(),           'schedule' => 'Selasa, 14.00 - 15.30'],
            ['name' => 'Hadroh',        'supervisor' => fake()->name(),           'schedule' => 'Sabtu, 14.00 - 16.00'],
        ];

        $ekskul = fake()->randomElement($ekskuls);

        return [
            'name'        => $ekskul['name'],
            'supervisor'  => $ekskul['supervisor'],
            'schedule'    => $ekskul['schedule'],
            'description' => fake()->paragraph(2),
            'photo'       => null,
            'is_active'   => true,
        ];
    }
}
