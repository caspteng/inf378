<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;


class TweetController extends Controller
{
    public function getAllTweet()
    {
        $getTweet = Tweet::orderBy('created_at')->get();
        return view('tweet.all')
            ->with('allTweets', $getTweet);
    }

    public function getAllUserTweetByUsername($name)
    {
        $user = User::where('username', $name)->firstOrFail();

        $getUserTweet = Tweet::where('user_id', $user->id)->get();

        return view('tweet.user')
            ->with('userTweets', $getUserTweet)
            ->with('user', $user);
    }

    public function showTweetForm()
    {
        return view('tweet.tweetform');
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:160|min:10'

        ]);
        Tweet::create([
            'message' => $request->message,
            'user_id' => auth()->user()->id,
        ]);

        return redirect(route('showTweetForm'));
    }
}
