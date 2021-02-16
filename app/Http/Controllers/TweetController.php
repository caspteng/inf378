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

    public function retweet($tweet_id)
    {
        /**
         * TODO Mettre une condition qui vérifie si l'utilisateur courant a déjà retweet un tweet.
         * TODO Si c'est le cas, on propose à l'utilisateur d'enlever son précédent retweet, sinon la fonction ci-dessous s'exécute.
         */
        Tweet::where('id', $tweet_id)->firstOrFail();

        if (!Tweet::alreadyRetweeted(auth()->user()->id, $tweet_id)) {
            Tweet::create([
                'is_retweet' => true,
                'user_id' => auth()->user()->id,
                'retweet_id' => $tweet_id,
            ]);
        }
    }

}
