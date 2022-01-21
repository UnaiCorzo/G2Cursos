<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordController;
use App\Models\Course;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::get('/email/verify', function () {
    return view('confirm');
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/es/true');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::group(['prefix' => '{language}'], function () {
    Route::get('/home', function () {
        return view('user');
    })->middleware('auth')->name('home');

    Route::get('/admin', function () {
        if (Gate::allows('access-admin')) {
            $users = User::select("*")
            ->whereNotNull('cv')
            ->where('role_id', 1)
            ->get();
            return view('admin', ['users' => $users, 'all_users' => User::all(), 'courses' => Course::all()]);
        }
        return redirect()->to(route('login', app()->getLocale()));
    })->name('admin');

    Route::post('/user', [UserController::class, 'store'])->name('user');
    Route::get('/profile', [UserController::class, 'myprofile'])->middleware('auth')->name('profile');
    Route::post('/profile/modify/{id}', [UserController::class, 'modify'])->middleware('auth')->name('profile_modify');
    Route::post('/profile/reset/password', [UserController::class, 'password'])->middleware('auth')->name('reset_password');
    Route::post('/profile/delete/{id}', [UserController::class, 'delete'])->middleware('auth')->name('delete_profile');
    Route::get('/course/view/{id}', [CourseController::class, 'course'])->middleware('auth')->name('course');
    Route::get('/course/route/{id}/{coordinates}', [CourseController::class, 'geolocalization'])->middleware('auth')->name('geolocalization');
    Route::post('/course/delete/{id}', [CourseController::class, 'delete'])->middleware('auth')->name('delete_course');
    Route::get('/find', [CourseController::class, 'find'])->middleware('auth')->name('find');
    Route::get('/course/create', [CourseController::class, 'create'])->middleware('auth')->name('create');
    Route::post('/session', [SessionController::class, 'store'])->name('session');
    Route::post('/file', [FileController::class, 'store'])->middleware('auth')->name('file');
    Route::post('/user/upgrade', [UserController::class, 'upgrade'])->name('upgrade');
    Route::get('/logout', [SessionController::class, 'destroy'])->name('logout');
    Route::get('/forgot-password', [PasswordController::class, 'index'])->middleware('guest')->name('password.request');
    Route::post('/course/store', [CourseController::class, 'store'])->name('course-store');

    Route::get('/{success?}', function ($lang, $success = false) {
        if ($success) {
            return view('index')->with('success', $success);
        }
        return view('index');
    })->name("login");
});

Route::get('/show/{file}', [FileController::class, 'show'])->name('show');


Route::get('/reset-password/{token}', function ($token) {
    return view('change_password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/forgot-password/send', [PasswordController::class, 'send'])->middleware('guest')->name('password-request');
Route::post('/forgot-password/reset', [PasswordController::class, 'reset'])->middleware('guest')->name('password-reset');