<?php

namespace App\Http\Controllers;

use App\Models\File;
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

            // Falta insertar empresa
            return redirect()->to('/logged')->withSuccess(__('File added successfully.'));
        }
        else{
            return redirect()->to('/logged');
        }
    }
    public function show(Request $request, $file)
    {
        return response()->download(public_path('files/' . $file));
    }
}
