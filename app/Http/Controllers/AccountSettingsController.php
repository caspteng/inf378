<?php

namespace App\Http\Controllers;

use App\Helpers\Hash;
use App\Helpers\Validation;
use Illuminate\Validation\Rule;

class AccountSettingsController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        return view('settings')
            ->with('user', $user)
            ->with('page_title', "Votre compte");
    }

    public function update()
    {
        $user = auth()->user();

        $attribute = request()->validate([
            'username' => [
                'required',
                'string',
                'alpha_num',
                'min:5',
                'max:15',
                Rule::unique('users')->ignore($user)
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user)
            ],
            'current_password' => ['required'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed']
        ], [
            'username.unique' => 'Le nom d\'utilisateur :input est déjà pris',
            'email.unique' => 'L\'adresse email :input est déjà utilisé',
            'password.min' => 'Ton nouveau mot de passe doit contenir au moins :min caractères',
        ]);
        if (Hash::make($attribute['current_password']) != $user->password) {
            return back()->withErrors(['current_password' => 'Ton mot de passe est incorrect']);
        }

        if ($attribute['username'] != $user->username) {
            if (!Validation::checkWords($attribute['username'])) {
                return back()->withErrors(['username' => 'Nom d\'utilisateur interdit']);
            } else {
                $attribute['username'] = strtolower($attribute['username']);
            }
        }

        $user->update($attribute);
        return redirect($user->path())
            ->with('flash.message', 'Compte actualisé')
            ->with('flash.class', 'success');
    }
}
