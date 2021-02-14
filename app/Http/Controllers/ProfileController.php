<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show($username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $is_profile_owner = false;
        $is_follow = false;

        if (Auth::check()) {
            $is_profile_owner = (Auth::id() == $user->id);
            $current_user = Auth::user();
            $is_follow = !$is_profile_owner && !$current_user->isFollowing($user);
        }
        return view('profile')
            ->with('user', $user)
            ->with('is_profile_owner', $is_profile_owner)
            ->with('is_follow', $is_follow);
    }
}
