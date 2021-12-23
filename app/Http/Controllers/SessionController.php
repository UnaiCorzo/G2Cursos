<?php

namespace App\Http\Controllers;





class SessionController extends Controller
{
    public function store()
    {
        if (auth()->attempt(request(['email', 'password'])) == false) {
            return back()->withErrors(['message' => 'El email o la contraseña no es correcta']);
        }
        return redirect()->to('/logged');
    }
    public function destroy()
    {
        auth()->logout();
        return redirect()->to('/');
    }
  /*  public function admin(){
        if (Gate::allows('access-admin',auth()->user())) {
            return view('admin');
        }
        else{
            return view('index');
        }
    }*/
}
