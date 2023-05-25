<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $categories = Category::all();
        $users = User::all();
        $blog1 = Blog::create([
            'title' => fake()->sentence(7),
            'excerpt' => fake()->sentence(15),
            'body' => fake()->paragraphs(rand(3, 7), true),
            'image_path' => 'blogs/1.jpg',
            'category_id' => $categories->random()->id,
            'user_id' => $users->random()->id,
            'published_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $blog2 = Blog::create([
            'title' => fake()->sentence(7),
            'excerpt' => fake()->sentence(15),
            'body' => fake()->paragraphs(rand(3, 7), true),
            'image_path' => 'blogs/2.jpg',
            'category_id' => $categories->random()->id,
            'user_id' => $users->random()->id,
            'published_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $blog3 = Blog::create([
            'title' => fake()->sentence(7),
            'excerpt' => fake()->sentence(15),
            'body' => fake()->paragraphs(rand(3, 7), true),
            'image_path' => 'blogs/3.jpg',
            'category_id' => $categories->random()->id,
            'user_id' => $users->random()->id,
            'published_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $blog4 = Blog::create([
            'title' => fake()->sentence(7),
            'excerpt' => fake()->sentence(15),
            'body' => fake()->paragraphs(rand(3, 7), true),
            'image_path' => 'blogs/4.jpg',
            'category_id' => $categories->random()->id,
            'user_id' => $users->random()->id,
            'published_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        $blog5 = Blog::create([
            'title' => fake()->sentence(7),
            'excerpt' => fake()->sentence(15),
            'body' => fake()->paragraphs(rand(3, 7), true),
            'image_path' => 'blogs/5.jpg',
            'category_id' => $categories->random()->id,
            'user_id' => $users->random()->id,
            'published_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        $tags = Tag::all();
        $blog1->tags()->attach(
            $tags->random(rand(2, $tags->count()))
                ->pluck('id')
                ->toArray()
        );
        $blog2->tags()->attach(
            $tags->random(rand(2, $tags->count()))
                ->pluck('id')
                ->toArray()
        );
        $blog3->tags()->attach(
            $tags->random(rand(2, $tags->count()))
                ->pluck('id')
                ->toArray()
        );
        $blog4->tags()->attach(
            $tags->random(rand(2, $tags->count()))
                ->pluck('id')
                ->toArray()
        );

        $blog5->tags()->attach(
            $tags->random(rand(2, $tags->count()))
                ->pluck('id')
                ->toArray()
        );


    }
}
