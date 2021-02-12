<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoftDeletesField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('tweets', function (Blueprint $table) {
            $table->softDeletes();
            $table->dropColumn('is_deleted');
        });

        Schema::table('tweets_comments', function (Blueprint $table) {
            $table->softDeletes();
            $table->dropColumn('is_deleted');
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->softDeletes();
            $table->dropColumn('is_deleted');
        });
        echo "Adding 'deleted_at' field successfully.\nRemember use 'Illuminate\Database\Eloquent\SoftDeletes' in your Model.\n";
        echo "More info on: https://laravel.com/docs/8.x/eloquent#soft-deleting\n";
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('tweets', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->boolean('is_deleted')->default(false);
        });

        Schema::table('tweets_comments', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->boolean('is_deleted')->default(false);
        });

        Schema::table('messages', function (Blueprint $table) {
            $table->dropSoftDeletes();
            $table->boolean('is_deleted')->default(false);
        });
    }
}
