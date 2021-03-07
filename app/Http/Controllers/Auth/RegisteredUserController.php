<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use TweetValidation;
use TweetHash;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'surname' => 'required|string|max:50|min:3',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'birthday' => 'required|before:-13 years',
           ], [
                'birthday.before' => 'Tu dois avoir minimum 13 ans pour t\'inscrire.',
                'email.unique' => 'L\'adresse email :input est déjà utilisé'
            ]);

        if (!TweetValidation::checkWords($request->surname)) {

            throw ValidationException::withMessages([
                'surname' => __('auth.invalid'),
            ]);
        }

        Auth::login($user = User::create([
            'username' => TweetValidation::generateUsername($request->surname),
            'surname' => $request->surname,
            'email' => $request->email,
            'birthday' => $request->birthday,
            'password' => $request->password,
        ]));

        event(new Registered($user));

        return redirect(RouteServiceProvider::HOME);
    }

}
