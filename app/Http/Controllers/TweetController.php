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
        $getTweet = Tweet::latest()->get();
        return view('tweet.all')
            ->with('allTweets', $getTweet);
    }

    public function store(Request $request)
    {
        $attribute = $request->validate([
            'message' => 'required|string|max:140|min:10'
        ]);

        Tweet::create([
            'message' => $attribute['message'],
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->back()
            ->with('flash.message', 'Le tweet a été publié')
            ->with('flash.class', 'success');
    }

    /**
     * Delete a Tweet
     *
     * @param int $tweet_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function drop(int $tweet_id): \Illuminate\Http\RedirectResponse
    {
        try {
            $tweet = Tweet::findOrFail($tweet_id);
        } catch (ModelNotFoundException $exp) {
            return $this->tweetNotExist();
            //return response()->json(['error' => 'Tweet doesn\'t exists']);
        }
        if ($tweet->user_id != auth()->user()->id || $tweet->is_retweet) {
            return redirect()->back()
                ->with('flash.message', 'Tu n\'a pas la permission de supprimer ce tweet')
                ->with('flash.class', 'error');
            //return response()->json(['error' => 'You don\'t have permission to delete this tweet']);
        }

        $tweet->delete();

        return redirect()->back()
            ->with('flash.message', 'Le tweet a été supprimé')
            ->with('flash.class', 'success');
        //return response()->json(['success' => 'Tweet removed']);
    }

    /**
     * Retweet if the user has not already retweeted this tweet
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function retweet(int $id)
    {
        try {
            $tweet = Tweet::findOrFail($id);
        } catch (ModelNotFoundException $exp) {
            return $this->tweetNotExist();
        }
        if ($tweet->is_retweet == true && $tweet->user_id == auth()->user()->id) {
            return redirect()->back()
                ->with('flash.message', 'Tu ne peux pas retweet ce tweet')
                ->with('flash.class', 'error');
        }
        Tweet::firstOrCreate([
            'is_retweet' => true,
            'user_id' => auth()->user()->id,
            'retweet_id' => $tweet->id
        ]);
        return redirect()->back()
            ->with('flash.message', 'Tu as retweet !')
            ->with('flash.class', 'success');
    }

    /**
     * Undo a retweet
     *
     * @param int $tweed_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function undoRetweet(int $tweed_id): \Illuminate\Http\RedirectResponse
    {
        try {
            $tweet = Tweet::where('retweet_id', $tweed_id)
                ->where('user_id', auth()->user()->id)
                ->FirstOrFail();
        } catch (ModelNotFoundException $exp) {
            return $this->tweetNotExist();
        }
        $tweet->delete();
        return redirect()->back()
            ->with('flash.message', 'Retweet supprimé')
            ->with('flash.class', 'success');

    }

    /**
     * Like/Unlike a Tweet
     *
     * @param $tweet_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function likeOrUnlike($tweet_id): \Illuminate\Http\RedirectResponse
    {
        $currentUser = User::find(Auth::id());
        try {
            $tweet = Tweet::findOrFail($tweet_id);
        } catch (ModelNotFoundException $exp) {
            return $this->tweetNotExist();
        }
        if ($currentUser->isLiking($tweet)) {
            $currentUser->liking()->detach($tweet->id);
            //return response()->json(['success' => 'Tweet unliked']);
            return redirect()->back();
        } else {
            $currentUser->liking()->attach($tweet->id);
            //return response()->json(['success' => 'Tweet liked']);
            return redirect()->back();
        }
    }

    public function tweetNotExist()
    {
        return redirect()->back()
            ->with('flash.message', 'Ce tweet n\'existe plus.')
            ->with('flash.class', 'error');
    }
}
