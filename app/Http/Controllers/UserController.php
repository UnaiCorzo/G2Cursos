<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function store(StoreUser $request)
    {
        $validatedData = $request->validated();
        User::create([
            'name' => $validatedData["name"],
            'surnames' => $validatedData["surnames"],
            'email' => strtolower($validatedData["email"]),
            'password' => $validatedData["password1"],
            'dni' => strtoupper($validatedData["dni"]),
            'role_id' => 1,
        ]);
        return redirect('/');
    }

    public function myprofile()
    {
        return view("profile");
    }

    public function modify(Request $request, $id)
    {
        $user_modify = User::find($id);
        if ($request->get("name") != null) {
            $user_modify->name = $request->get("name");
        }
        if ($request->get("surnames") != null) {
            $user_modify->surnames = $request->get("surnames");
        }
        if ($request->get("email") != null) {
            $user_modify->email = strtolower($request->get("email"));
        }

        $user_modify->save();
        return redirect('/profile');
    }

    public function password(Request $request)
    {
        $password = $request->get('password1');

        if (auth()->attempt(['email' => auth()->user()->email, "password" => $password]) == true) {
            $user_modify = User::find(auth()->user()->id);
            $new_password = $request->get('password2');
            $user_modify->password = $new_password;
            $user_modify->save();
            auth()->logout();

            return redirect('/');
        }
        return back()->withErrors(['message' => 'La contraseña no es correcta']);
    }
}
