<?php

namespace Database\Factories;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Symfony\Component\Clock\now;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'slug' => $this->faker->unique()->slug,
            'excerpt' => $this->faker->paragraph,
            'content' => $this->faker->text(2000),
            'image_path' => $this->faker->imageUrl(1280, 720, 'tech', true),
            'user_id' => 1,
            'category_id' => \App\Models\Category::all()->random()->id ?? 1,
            'is_published' => true,
            'published_at' => now(),
        ];
    }
}
