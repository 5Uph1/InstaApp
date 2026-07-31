<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::factory(5)->create();

        $mainUser = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $allUsers = $users->push($mainUser);

        $posts = collect();
        $allUsers->each(function ($user) use (&$posts) {
            $userPosts = Post::factory(3)->create(['user_id' => $user->id]);
            $posts = $posts->merge($userPosts);
        });

        $posts->each(function ($post) use ($allUsers) {
            $allUsers->random(rand(0, $allUsers->count()))->each(function ($user) use ($post) {
                Like::factory()->create([
                    'user_id' => $user->id,
                    'post_id' => $post->id,
                ]);
            });
        });

        $posts->each(function ($post) use ($allUsers) {
            Comment::factory(rand(0, 4))->create([
                'post_id' => $post->id,
                'user_id' => $allUsers->random()->id,
            ]);
        });
    }
}