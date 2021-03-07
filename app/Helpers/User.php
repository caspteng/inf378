<?php


namespace App\Helpers;

use App\Models\Tweet;
use Illuminate\Support\Facades\DB;

/**
 * User Helper
 *
 * @package App\Helpers
 */
class User
{
    /**
     * Get username from ID
     *
     * @param $user_id
     * @return string
     */
    public static function getUsername(int $user_id): string
    {
        $user = DB::table('users')->where('id', $user_id)->first();
        return '@' . $user->username ?? '';
    }

    public static function getFollowCount(int $user_id): int
    {
        return DB::table('follows')->where('user_followed', $user_id)->count();
    }

    public static function getLikeCount(int $tweet_id): int
    {
        return DB::table('likes')->where('tweet_id', $tweet_id)->count();
    }
    public static function getRetweetCount(int $tweet_id): int
    {
        return Tweet::where('retweet_id', $tweet_id)->count();
    }

}
