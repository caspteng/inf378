<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Auth;


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

    /**
     * Retweet if the user has not already retweeted this tweet
     *
     * @param int $id
     */
    public function retweet(int $id)
    {
        $tweet = Tweet::findOrFail($id);

        Tweet::firstOrCreate([
            'is_retweet' => true,
            'user_id' => auth()->user()->id,
            'retweet_id' => $tweet->id
        ]);
    }

    /**
     * Undo a retweet
     *
     * @param int $tweed_id
     */
    public function undoRetweet(int $tweed_id)
    {
        $tweet = Tweet::where('retweet_id', $tweed_id)
            ->where('user_id', auth()->user()->id)
            ->FirstOrFail();

        $tweet->delete();

    }

    public function like($tweet_id)
    {
        // TODO Condition si le lien existe déjà (like déjà présent avec le même current user, passer attach à detach
        $currentUser = auth()->user()->id;
        $tweet = Tweet::where('id', $tweet_id)->firstOrFail();
        $currentUser->liking()->attach($tweet->id);
    }
}
