<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class SecurityController extends Controller
{
    /**
     * @param $password
     * @return string
     */
    public static function myHash($password): string
    {
        return hash_hmac(config('auth.encrypt_method'), $password, config('auth.encrypt_key'));
    }
}
