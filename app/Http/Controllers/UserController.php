<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function store(StoreUser $request){
        $validatedData = $request->validated();
        \App\Models\User::create([
            'name' => $validatedData["name"],
            'surnames' => $validatedData["surnames"],
            'email' => $validatedData["email"],
            'password' => $validatedData["password1"],
            'dni' => $validatedData["dni"],
            'role_id' => 1,
        ]);
        return redirect('/');    
    }
}
