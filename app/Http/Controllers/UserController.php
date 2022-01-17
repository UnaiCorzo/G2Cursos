<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUser;
use App\Models\User;
use App\Notifications\NotificarCreador;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function store(StoreUser $request)
    {
        $validatedData = $request->validated();
        $user = User::create([
            'name' => $validatedData["name"],
            'surnames' => $validatedData["surnames"],
            'email' => strtolower($validatedData["email"]),
            'password' => $validatedData["password1"],
            'dni' => strtoupper($validatedData["dni"]),
            'role_id' => 1,
        ]);
        auth()->login($user);
        event(new Registered($user));
        return redirect()->route('verification.notice', app()->getLocale());
    }

    public function myprofile()
    {
        return view("profile");
    }

    public function modify(Request $request, $lang, $id)
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
        return redirect()->to(route('profile', $lang));
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

            return redirect()->to(route('login', app()->getLocale()));
        }
        $message = 'La contraseña no es correcta';
        if (app()->getLocale() == "en") {
            $message = 'Password is not correct';
        } else if (app()->getLocale() == "en") {
            $message = 'Pasahitza ez da zuzena';
        }
        return back()->withErrors(['message' => $message]);
    }

    public function upgrade(Request $request)
    {
        $user = User::findOrFail($request->user);
        $image_path = public_path() . '/files' . '/' . $user->cv;
        unlink($image_path);

        if ($request->btn == "accept") {
            DB::table('users')
                ->where('id', $request->user)
                ->update(['role_id' => 2, 'cv' => null]);
            $user->notify(new NotificarCreador());
        } else {
            DB::table('users')
                ->where('id', $request->user)
                ->update(['cv' => null]);
        }
        return back();
    }

    public function delete($lang, $id)
    {
        $user_delete = User::find($id);
        $user_delete->delete();
        return redirect()->to(route('login', app()->getLocale()));
    }
}
