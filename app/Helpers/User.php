<?php


namespace App\Helpers;

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
}
