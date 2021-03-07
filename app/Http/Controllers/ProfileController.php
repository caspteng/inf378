<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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

    public function showFollowing(User $user)
    {
        $is_owner = false;
        if (Auth::check()) {
            $is_owner = auth()->user()->id == $user->id;
        }
        $followings = $user->following()->latest()->paginate(50);
        return view('profile.following', compact('followings',
            'is_owner', 'user'))
            ->with('page_title', 'Personnes suivies par ' . $user->surname);
    }

    public function showFollowers(User $user)
    {
        $is_owner = false;
        if (Auth::check()) {
            $is_owner = auth()->user()->id == $user->id;
        }
        $followers = $user->follower()->latest()->paginate(50);
        return view('profile.followers', compact('followers',
            'is_owner', 'user'))
            ->with('page_title', 'Personnes qui suivent ' . $user->surname);
    }

    public function update(User $user)
    {
        $attribute = request()->validate([
            'surname' => 'required|string|max:50|min:3',
            'biography' => 'max:160',
            'avatar_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if (request()->hasFile('avatar_picture')) {
            $attribute['avatar_picture'] = request('avatar_picture')->store('avatars');
            Image::make('storage/' . $attribute['avatar_picture'])->fit(500)->encode('jpg', 100)->save();
        }

        $user->update($attribute);
        return redirect($user->path())
            ->with('flash.message', 'Profil actualisé')
            ->with('flash.class', 'success');
    }
}
