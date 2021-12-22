<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\FileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});
Route::get('/logged', function () {
    return view('user');
});

Route::post('/user', [UserController::class, 'store']);
Route::post('/session', [SessionController::class, 'store']);
Route::post('/file', [FileController::class, 'store']);
Route::get('/show/{file}',[FileController::class,'show']);
Route::get('/logout', [SessionController::class, 'destroy']);