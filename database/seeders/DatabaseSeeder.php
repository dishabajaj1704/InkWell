<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = ['Sports', 'Technology', 'Gaming'];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }


        $tags = ['Coding', 'Programming', 'Cs'];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}
