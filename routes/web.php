<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Models\Course;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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

Route::get('/reset-password/{token}', function ($token) {
    return view('change_password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/forgot-password/send', [PasswordController::class, 'send'])->middleware('guest')->name('password-request');
Route::post('/forgot-password/reset', [PasswordController::class, 'reset'])->middleware('guest')->name('password-reset');

Route::get('/show/{file}', [FileController::class, 'show'])->middleware('verified')->middleware('auth')->name('show');

Route::group(['prefix' => '{language}'], function () {
    Route::get('/home', function () {
        return view('user');
    })->middleware('auth')->name('home');

    Route::get('/admin', [UserController::class, 'admin'])->name('admin');
    Route::post('/user', [UserController::class, 'store'])->name('user');
    Route::get('/profile', [UserController::class, 'myprofile'])->middleware('verified')->middleware('auth')->name('profile');
    Route::post('/profile/modify/{id}', [UserController::class, 'modify'])->middleware('verified')->middleware('auth')->name('profile_modify');
    Route::post('/profile/reset/password', [UserController::class, 'password'])->middleware('verified')->middleware('auth')->name('reset_password');
    Route::post('/profile/delete/{id}', [UserController::class, 'delete'])->middleware('verified')->middleware('auth')->name('delete_profile');
    Route::get('/course/view/{id}', [CourseController::class, 'course'])->middleware('verified')->middleware('auth')->name('course');
    Route::get('/course/route/{id}/{coordinates}', [CourseController::class, 'geolocalization'])->middleware('verified')->middleware('auth')->name('geolocalization');
    Route::post('/course/delete/{id}', [CourseController::class, 'delete'])->middleware('verified')->middleware('auth')->name('delete_course');
    Route::get('/course/subscribe/{id}', [CourseController::class, 'subscribe'])->middleware('verified')->middleware('auth')->name('subscribe');
    Route::get('/course/unsubscribe/{id}', [CourseController::class, 'unsubscribe'])->middleware('verified')->middleware('auth')->name('unsubscribe');
    Route::get('/find', [CourseController::class, 'find'])->middleware('verified')->middleware('auth')->name('find');
    Route::get('/find/all', [CourseController::class, 'findAll'])->middleware('verified')->middleware('auth')->name('find_all');
    Route::get('/course/create', [CourseController::class, 'create'])->middleware('verified')->middleware('auth')->name('create');
    Route::get('/course/list', [CourseController::class, 'creatorCourses'])->middleware('verified')->middleware('auth')->name('created_courses');
    Route::get('/course/edit/{id}', [CourseController::class, 'editCourse'])->middleware('verified')->middleware('auth')->name('edit_course');
    Route::post('/course/modify', [CourseController::class, 'modifyCourse'])->middleware('verified')->middleware('auth')->name('course-modify');
    Route::post('/session', [SessionController::class, 'store'])->name('session');
    Route::post('/file', [FileController::class, 'store'])->middleware('verified')->middleware('auth')->name('file');
    Route::post('/user/upgrade', [UserController::class, 'upgrade'])->middleware('verified')->middleware('auth')->name('upgrade');
    Route::post('/course/rate/{id}', [CourseController::class, 'rate'])->middleware('auth')->name('rate');
    Route::get('/logout', [SessionController::class, 'destroy'])->name('logout');
    Route::get('/forgot-password', [PasswordController::class, 'index'])->name('password.request');
    Route::post('/course/store', [CourseController::class, 'store'])->middleware('auth')->name('course-store');
    Route::post('/contact/send', [ContactController::class, 'store'])->name('contact_send');
    Route::post('/contact/delete/{id}', [ContactController::class, 'delete'])->name('contact_delete');

    Route::get('/{success?}', function ($lang, $success = "false") {
        if ($success == "true") {
            return view('index')->with('success', $success)->with('courses', Course::inRandomOrder()->limit(3)->get());
        } else if ($success != "false" || ($lang != 'es' && $lang != 'en' && $lang != 'eu')) {
            abort(404);
        }
        return view('index', ['courses' => Course::inRandomOrder()->limit(3)->get()]);
    })->name("login");
});
