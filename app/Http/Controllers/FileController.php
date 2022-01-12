<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    public function store(Request $request)
    {

        if (isset($request->file)) {
            $fileName = auth()->user()->name . '_' . time() . 'CV.' . $request->file->extension();


            $request->file->move(public_path('files'), $fileName);

            DB::table('users')
                ->where('id', auth()->user()->id)
                ->limit(1)
                ->update(array('cv' => $fileName));

            if (isset($request->name)) {
                $nombre = strtolower($request->name);
                $id = DB::table('companies')
                    ->where('name', $nombre)
                    ->value('id');
  
                if (is_null($id)) {
                    $id = DB::table('companies')->insertGetId(
                        ['name' => $nombre, 'direction' => $request->address,'location'=>$request->locality]
                    );  
                } 
                DB::table('users')
                    ->where('id', auth()->user()->id)
                    ->limit(1)
                    ->update(array('company_id' => $id));
            }
            return redirect()->to(route('home', app()->getLocale()))->withSuccess(__('File added successfully.'));
        } else {
            return redirect()->to(route('home', app()->getLocale()));
        }
    }
    public function show(Request $request, $lang, $file)
    {
        return response()->download(public_path("asset('files/" . $file . "')"));
    }

}
