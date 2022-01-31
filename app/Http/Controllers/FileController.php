<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request)
    {
        if (isset($request->file)) {
            $fileName = auth()->user()->name . '_' . time() . 'CV.' . $request->file->extension();

            if (auth()->user()->cv != null) {
                $user = User::find(auth()->user()->id);
                $image_path = storage_path('app/' . $user->cv);
                unlink($image_path);
            }
            Storage::disk('local')->put($fileName, 'Contents');

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
                        ['name' => $nombre, 'direction' => $request->address, 'location' => $request->locality]
                    );
                }
                DB::table('users')
                    ->where('id', auth()->user()->id)
                    ->limit(1)
                    ->update(array('company_id' => $id));
            } else if (auth()->user()->company_id != null) {
                $user = User::find(auth()->user()->id);
                $user->company_id = null;
                $user->save();
            }
            return redirect()->to(route('home', app()->getLocale()))->withSuccess(__('File added successfully.'));
        }
        return redirect()->to(route('home', app()->getLocale()));
    }

    public function show($file)
    {
        return response()->download(storage_path('app/' . $file));
    }
}
