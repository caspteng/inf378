<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Tweet Character Limit
    |--------------------------------------------------------------------------
    |
    | Limit character for a Tweet
    |
    */

    'characterlimit' => env('TWEET_CHARACTER_LIMIT', '140'),

    /*
    |--------------------------------------------------------------------------
    | Invalid Usernames
    |--------------------------------------------------------------------------
    |
    | Invalid User Names for Users
    | Check if User contains something like that
    |
    */

    'invalid' => [
        'MOD_',
        'MOD-',
        'Admin_',
        'Admin-',
        'profil',
        'register',
        'login',
        'twitter',
        'tweet',
        'follow',
        'index',
        'settings',
        'pute',
        'abruti',
        'abrutie',
        'baiser',
        'batard',
        'bougnoul',
        'branleur',
        'connard',
        'connasse',
        'enculer',
        'partouze',
        'petasse',
        'pouffiasse',
        'putain',
        'pute',
        'salaud',
        'salopard',
        'salope',
        'sodomie',
    ],

];
