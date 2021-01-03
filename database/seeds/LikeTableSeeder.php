<?php

use App\Like;
use Illuminate\Database\Seeder;

class LikeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $like = new Like;
        $like->post_id = 1;
        $like->website_user_id = 1;
        $like->save();

        factory(App\Like::class, 50)->create();
    }
}
