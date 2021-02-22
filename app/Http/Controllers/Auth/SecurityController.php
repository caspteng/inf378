<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class SecurityController extends Controller
{
    /**
     *  Custom method for hashing the user password
     *
     * @param $password
     * @return string
     */
    public static function myHash($password): string
    {
        return hash_hmac(config('auth.encrypt_method'), $password, config('auth.encrypt_key'));
    }
}
