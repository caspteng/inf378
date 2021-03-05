<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(User $user)
    {
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
            ->with('is_follow', $is_follow)
            ->with('page_title', "$user->surname (@$user->username)");
    }

    public function update(User $user)
    {
        $attribute = request()->validate([
            'surname' => 'required|string|max:50|min:3',
            'biography' => 'max:160'
        ]);

        $user->update($attribute);
        return redirect($user->path())
            ->with('flash.message', 'Profil actualisé')
            ->with('flash.class', 'success');
    }
}
