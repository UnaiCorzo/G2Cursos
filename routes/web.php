<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/es');

Route::group(['prefix' => '{language}'], function () {
    Route::get('/', function () {
        return view('index');
    })->name("login");

    Route::get('/home', function () {
        return view('user');
    })->middleware('auth')->name('home');

    Route::get('/admin', function () {
        if (Gate::allows('access-admin')) {
            $users = User::select("*")
            ->whereNotNull('cv')
            ->where('role_id', 1)
            ->get();
            return view('admin', ['users' => $users]);
        }
        return redirect()->to(route('login', app()->getLocale()));
    })->name('admin');

    Route::post('/user', [UserController::class, 'store'])->name('user');
    Route::get('/profile', [UserController::class, 'myprofile'])->middleware('auth')->name('profile');
    Route::post('/profile/modify/{id}', [UserController::class, 'modify'])->name('profile_modify');
    Route::post('/profile/reset/password', [UserController::class, 'password'])->name('reset_password');
    Route::get('/course', [CourseController::class, 'course'])->middleware('auth')->name('course');
    Route::get('/find', [CourseController::class, 'find'])->middleware('auth')->name('find');
    Route::post('/session', [SessionController::class, 'store'])->name('session');
    Route::post('/file', [FileController::class, 'store'])->name('file');
    Route::post('/user/upgrade', [UserController::class, 'upgrade'])->name('upgrade');
    Route::get('/logout', [SessionController::class, 'destroy'])->name('logout');
});

Route::get('/show/{file}', [FileController::class, 'show'])->name('show');
