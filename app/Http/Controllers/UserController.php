<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function follow($id)
    {
        try {
            $is_followed = User::findOrFail($id);
        } catch (ModelNotFoundException $exp) {
            return response()->json(['error' => 'User doesn\'t exists']);
        }
        $follower_user = User::find(Auth::id());

        if (!$follower_user->isFollowing($is_followed)) {
            $follower_user->following()->attach($is_followed->id);
        }
        return response()->json(['success' => 'User followed']);
    }

    public function unfollow($id)
    {
        $is_followed = User::findOrFail($id);
        $follower_user = User::find(Auth::id());

        $follower_user->following()->detach($is_followed->id);

        return response()->json(['success' => 'User unfollowed']);
    }


}

