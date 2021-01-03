<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friendships', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('website_user_id');
            $table->unsignedBigInteger('website_user_friend_id');
            $table->boolean('accepted');
            $table->boolean('read');

            $table->foreign('website_user_id')->references('id')->
                on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('website_user_friend_id')->references('id')->
                on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friendships');
    }
}
