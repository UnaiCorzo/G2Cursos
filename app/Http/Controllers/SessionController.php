<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function store(Request $request)
    {
        if (isset($request->remember_me)) {
            $remember_me = true;
        }
        else{
            $remember_me = false;
        }
        if (auth()->attempt(request(['email', 'password']),$remember_me) == false) {
            $message = 'El email o la contraseña no es correcta';
            if (app()->getLocale() == "en") {
                $message = 'Email or password is not correct';
            } else if (app()->getLocale() == "eu") {
                $message = 'Posta elektronikoa edo pasahitza ez da zuzena';
            }
            return back()->withErrors(['message' => $message]);
        }
        return redirect()->to(route('home', app()->getLocale()));
    }

    public function destroy()
    {
        auth()->logout();
        return redirect()->to(route('login', app()->getLocale()));
    }
}
