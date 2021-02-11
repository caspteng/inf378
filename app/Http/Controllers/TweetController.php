<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;

class TweetController extends Controller
{
    public function getAllTweet()
    {
        $tweets = Tweet::orderBy('created_at')->get();
        return view('tweet.all', [
            'tweets' => $tweets,
        ]);
    }

    public function getAllUserTweetByUsername($name)
    {

        $user = User::where('username', $name)->first();
        if (is_null($user)) {
            abort(404);
        }
        $tweets = Tweet::where('user_id', $user->id)->get();

        return view('tweet.user', [
            'tweets' => $tweets,
        ]);
    }
}
