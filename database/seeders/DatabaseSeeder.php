<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
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
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::factory(1)->create([
            'role' => 'admin'
        ]);

        User::factory(150)->create([
            'role' => 'user'
        ]);

        $user = User::all()->shuffle()->where('role', 'user');


        Category::factory(5)->create();

        $categories = Category::all();
        foreach ($categories as $category) {
            
            for ($i = 0; $i < 10; $i++) {
                Post::factory()->create([
                    'category_id' => $category->id,

                    'user_id' => $user->random()->id
                ]);
            }
        }

        $posts = Post::all()->shuffle();

        foreach ($posts as $post) {
            for ($i = 0; $i < 3; $i++) {
                Comment::factory()->create([
                    'post_id' => $post->id,
                    'user_id' => $user->pop()->id
                ]);
            }
        }
    }
}
