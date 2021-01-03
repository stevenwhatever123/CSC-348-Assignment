<?php

use App\Comment;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment = new Comment;
        $comment->description = 'I Agree with you';
        $comment->post_id = 1;
        $comment->website_user_id = 1;
        $comment->save();

        factory(App\Comment::class, 50)->create();
    }
}
