<?php


namespace App\Helpers;

use App\Models\User;
use Faker\Provider\Person;

/**
 * Validation Helper
 *
 * @package App\Helpers
 */
class Validation
{

    /**
     *
     * Generate a unique username
     *
     * @param $username
     * @return string
     */
    public static function generateUsername($username): string
    {
        $filterUsername = preg_replace("/[^a-zA-Z0-9]+/", "", $username);
        $newusername = trim(strtolower($filterUsername));

        if (User::where('username', '=', $newusername)->first()) {
            $newusername .= Person::randomNumber(1);
            return self::generateUsername($newusername);
        }
        return $newusername;
    }

    /**
     * Check for Illegal Words.
     *
     * @param string $needle
     *
     * @return bool
     */
    public static function checkWords(string $needle): bool
    {
        return count(array_filter(config('tweet.invalid'), function ($illegal) use ($needle) {
                return stripos($needle, $illegal) !== false;
            })) == 0;
    }
}
