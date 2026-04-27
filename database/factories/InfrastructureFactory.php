<?php

namespace Database\Factories;

use App\Models\Infrastructure;
use Illuminate\Database\Eloquent\Factories\Factory;

class InfrastructureFactory extends Factory
{
    public function definition(): array
    {
        $facilities = [
            'Ruang Kelas', 'Laboratorium IPA', 'Laboratorium Komputer',
            'Perpustakaan', 'Masjid / Musholla', 'Lapangan Olahraga',
            'Ruang Guru', 'Ruang Kepala Sekolah', 'Ruang Tata Usaha',
            'Kantin', 'Toilet Siswa', 'Toilet Guru', 'Gudang',
            'Ruang UKS', 'Ruang BK', 'Aula / Gedung Pertemuan',
        ];

        return [
            'name'        => fake()->randomElement($facilities),
            'condition'   => fake()->randomElement(array_keys(Infrastructure::CONDITIONS)),
            'description' => fake()->paragraph(2),
            'photo'       => null,
            'quantity'    => fake()->numberBetween(1, 20),
        ];
    }
}
