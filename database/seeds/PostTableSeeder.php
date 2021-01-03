<?php

use App\Post;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = new Post;
        $post->description = 'Taiwan No.1';
        $post->SFW = false;
        $post->website_user_id = 1;
        $post->save();

        factory(App\Post::class, 50)->create();
    }
}
