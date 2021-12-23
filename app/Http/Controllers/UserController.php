<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function store(StoreUser $request){
        $validatedData = $request->validated();
        User::create([
            'name' => $validatedData["name"],
            'surnames' => $validatedData["surnames"],
            'email' => $validatedData["email"],
            'password' => $validatedData["password1"],
            'dni' => $validatedData["dni"],
            'role_id' => 1,
        ]);
        return redirect('/');    
    }

    public function myprofile() {
        return view("profile");
    }

    public function modify(Request $request, $id) {
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
}
