<?php

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/course', function(){
    return Course::all('name','location','description');
});
Route::get('/course/{course}', function(Course $course){
    return response()->json($course,201);
});
Route::get('/category', function(){
    return Category::all('name','color');
});
Route::get('/category/{category}', function(Category $category){
    return response()->json($category,201);
});

