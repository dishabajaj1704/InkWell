<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'disha',
            'email' => 'disha17@gmail.com',
            'password' => Hash::make('disha1234'),
            'role' => 'admin',
        ]);


        \App\Models\User::factory(10)->create();


        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = ['Sports', 'Technology', 'Gaming'];

        foreach ($categories as $category) {
            $user = User::all()->random();
            Category::create([
                'name' => $category,
                "created_by" => $user->id,
                "last_updated_by" => $user->id

            ]);
        }


        $tags = ['Coding', 'Python', 'Cs', 'Java'];

        foreach ($tags as $tag) {
            $user = User::all()->random();
            Tag::create([

                'name' => $tag,
                "created_by" => $user->id,
                "last_updated_by" => $user->id
            ]);
        }

        $this->call(BlogsSeeder::class);



        $blogs = Blog::all();
        $users = User::all();
        $comment1 = Comment::create([
            'message' => fake()->sentence(7),
            'verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'blog_id' => $blogs->random()->id,
            'user_name' => fake()->word(),
            'user_email' => fake()->email(),
            // 'user_id' => $users->random()->id,
        ]);
        $comment2 = Comment::create([
            'message' => fake()->sentence(7),
            'verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'blog_id' => $blogs->random()->id,
            'user_name' => fake()->word(),
            'user_email' => fake()->email(),
            // 'user_id' => $users->random()->id,
        ]);
        $comment3 = Comment::create([
            'message' => fake()->sentence(7),
            'verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'blog_id' => $blogs->random()->id,
            'user_name' => fake()->word(),
            'user_email' => fake()->email(),
            // 'user_id' => $users->random()->id,
        ]);
    }
}
