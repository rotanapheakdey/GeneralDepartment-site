<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(6),
            'document_type' => $this->faker->randomElement(['prakas', 'sub_decree', 'notification', 'directive']),
            'file_path' => 'documents/sample.pdf', // Ensure a dummy PDF exists in storage
            'published_date' => $this->faker->date(),
            'description' => $this->faker->paragraph(),
        ];
    }
}
