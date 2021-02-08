<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tweets', function (Blueprint $table) {
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('user_id_retweet')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('retweet_id')
                ->references('id')
                ->on('tweets')
                ->cascadeOnDelete();
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->foreign('receiver_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('sender_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('tweet_id')
                ->references('id')
                ->on('tweets')
                ->cascadeOnDelete();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });

        Schema::table('follows', function (Blueprint $table) {
            $table->foreign('user_followed')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('user_as_follow')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tweets', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('user_id_retweet');
            $table->dropForeign('retweet_id');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign('receiver_id');
            $table->dropForeign('sender_id');
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->dropForeign('user_id');
            $table->dropForeign('tweet_id');
        });

        Schema::table('follows', function (Blueprint $table) {
            $table->dropForeign('user_as_follow');
            $table->dropForeign('user_followed');
        });
    }
}
