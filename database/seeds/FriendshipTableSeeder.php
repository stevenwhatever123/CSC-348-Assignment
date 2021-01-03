<?php

use App\Friendship;
use Illuminate\Database\Seeder;

class FriendshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $friendship = new Friendship;
        $friendship->website_user_id = 1;
        $friendship->website_user_friend_id = 2;
        $friendship->accepted = true;
        $friendship->save();

        factory(App\Friendship::class, 50)->create();
    }
}
