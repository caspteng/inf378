<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function retweet(int $id)
    {
        try {
            $tweet = Tweet::findOrFail($id);
        } catch (ModelNotFoundException $exp) {
            return response()->json(['error' => 'Tweet doesn\'t exists']);
        }
        Tweet::firstOrCreate([
            'is_retweet' => true,
            'user_id' => auth()->user()->id,
            'retweet_id' => $tweet->id
        ]);
        return response()->json(['success' => 'Tweet retweeted !']);
    }

    /**
     * Undo a retweet
     *
     * @param int $tweed_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function undoRetweet(int $tweed_id)
    {
        try {
            $tweet = Tweet::where('retweet_id', $tweed_id)
                ->where('user_id', auth()->user()->id)
                ->FirstOrFail();
        } catch (ModelNotFoundException $exp) {
            return response()->json(['error' => 'Tweet doesn\'t exists']);
        }
        $tweet->delete();
        return response()->json(['success' => 'Retweet canceled']);

    }

    /**
     * Like/Unlike a Tweet
     *
     * @param $tweet_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function likeOrUnlike($tweet_id): \Illuminate\Http\JsonResponse
    {
        $currentUser = auth()->user()->id;
        try {
            $tweet = Tweet::where('id', $tweet_id)->firstOrFail();
        } catch (ModelNotFoundException $exp) {
            return response()->json(['error' => 'Tweet doesn\'t exists']);
        }
        if ($currentUser->isLiking($tweet->id)) {
            $currentUser->liking()->detach($tweet->id);
            return response()->json(['success' => 'Tweet unliked']);
        } else {
            $currentUser->liking()->attach($tweet->id);
            return response()->json(['success' => 'Tweet liked']);
        }
    }
}
