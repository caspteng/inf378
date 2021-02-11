<?php

namespace App\Http\Controllers;
use App\Models\Tweet;

class TweetController extends Controller
{
    public function getAllTweet()
    {
        foreach (Tweet::all() as $tweet) {
            echo $tweet->message;
        }
    }
}
