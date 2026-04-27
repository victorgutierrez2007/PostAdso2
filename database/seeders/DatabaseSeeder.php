<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::updateOrCreate(
            ['email' => 'victor@gmail.com'],
            [
                'name' => 'victor gutierrez',
                'password' => bcrypt('victor123'),
            ]
        );

        $categories = collect(['Tecnología', 'Programación', 'Diseño Web', 'Laravel', 'IA'])->map(function ($name) {
            return Category::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($name)],
                ['name' => $name]
            );
        });

        $tags = collect(['Nuevo', 'Tutorial', 'Tip', 'Destacado', 'Actualidad'])->map(function ($name) {
            return \App\Models\Tag::updateOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($name)],
                ['name' => $name]
            );
        });

        Post::factory(20)->create([
            'user_id' => $user->id,
        ])->each(function ($post) use ($tags) {
            $post->tags()->attach($tags->random(rand(1, 3))->pluck('id'));
        });
    }
}
