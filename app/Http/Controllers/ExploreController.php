<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use App\Models\User;

class ExploreController extends Controller
{
    public function show()
    {
        $user = User::find(auth()->user()->id);
        $tweets = Tweet::latest()->paginate(50);

        return view('explore')
            ->with('user', $user)
            ->with('latest_tweets', $tweets)
            ->with('page_title', 'Explorer');
    }
}
