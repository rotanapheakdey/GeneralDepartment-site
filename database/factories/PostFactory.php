<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'content' => $this->faker->paragraphs(3, true),
            'excerpt' => $this->faker->sentence(),
            'category_id' => \App\Models\Category::inRandomOrder()->first()?->id,
            'featured_image' => 'https://picsum.photos/seed/' . rand(1, 1000) . '/800/600',
            'status' => 'published',
            'published_at' => now(),
        ];
    }
}
