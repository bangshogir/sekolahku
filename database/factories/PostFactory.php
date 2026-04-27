<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    public function definition(): array
    {
        $categories = ['Akademik', 'Kegiatan', 'Pengumuman', 'Prestasi', 'Umum', 'Humas'];
        $title      = fake()->sentence(rand(5, 10));

        return [
            'user_id'        => User::factory(),
            'title'          => $title,
            'slug'           => Str::slug($title) . '-' . fake()->unique()->numberBetween(1, 9999),
            'excerpt'        => fake()->paragraph(2),
            'content'        => implode("\n\n", fake()->paragraphs(rand(4, 7))),
            'category'       => fake()->randomElement($categories),
            'featured_image' => null,
            'is_published'   => fake()->boolean(80), // 80% kemungkinan published
            'published_at'   => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function published(): static
    {
        return $this->state([
            'is_published' => true,
            'published_at' => fake()->dateTimeBetween('-6 months', 'now'),
        ]);
    }
}
