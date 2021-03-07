<?php


namespace App\Helpers;

/**
 * Hash Helper
 *
 * @package App\Helpers
 */
class Hash
{
    /**
     *  Custom method for hashing the user password
     *
     * @param $password
     * @return string
     */
    public static function make($password): string
    {
        return hash_hmac(config('auth.encrypt_method'), $password, config('auth.encrypt_key'));
    }
}
