<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Post::updateOrCreate([
            'title' => 'My first post',
            'slug' => 'my-first-post',
            'content' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.</p>',
            'image' => 'https://picsum.photos/200/300',
            'likes' => 5,
            'created_at' => '2021-04-27 05:47:11',
        ]);
        Post::updateOrCreate([
            'title' => 'My first post 2',
            'slug' => 'my-first-post 2',
            'content' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.</p>',
            'image' => 'https://picsum.photos/200/300',
            'likes' => 4,
            'created_at' => '2021-04-27 05:47:11',
        ]);
        Post::updateOrCreate([
            'title' => 'My first post 3',
            'slug' => 'my-first-post 3',
            'content' => '<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatum.</p>',
            'image' => 'https://picsum.photos/200/300',
            'likes' => 3,
            'created_at' => '2021-04-27 05:47:11',
        ]);
    }
}
