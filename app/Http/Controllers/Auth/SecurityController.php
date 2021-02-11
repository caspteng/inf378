<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class SecurityController extends Controller
{
    public static function myHash($password)
    {
        return hash_hmac('ripemd160', $password, config('auth.encrypt_key'));
    }
}
