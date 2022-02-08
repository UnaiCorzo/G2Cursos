<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        Contact::create([
            'name' => $request->name,
            'email' => strtolower($request->email),
            'phone' => $request->phone,
            'comments' => $request->comments,
        ]);

        return redirect()->to(route('login', app()->getLocale()));
    }

    public function delete($lang, $id)
    {
        Contact::find($id)->delete();
        return redirect()->to(route('admin', $lang));
    }
}
