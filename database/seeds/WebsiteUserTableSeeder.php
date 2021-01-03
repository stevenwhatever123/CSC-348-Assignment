<?php

use App\WebsiteUser;
use Illuminate\Database\Seeder;

class WebsiteUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $website_user = new WebsiteUser;
        $website_user->name = "John";
        $website_user->date_of_birth = '1999-1-1';
        $website_user->email = 'ggggggg@gg.com';
        $website_user->password = 'NeverGonnaGiveYouUp';
        $website_user->save();

        factory(WebsiteUser::class, 50)->create();
    }
}
