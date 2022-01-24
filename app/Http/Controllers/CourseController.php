<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function course($lang, $id)
    {
        $course = Course::find($id);
        $hasRated = false;
        $hasSubscribed = false;
        for ($i=0; $i <count(auth()->user()->ratings) ; $i++) { 
            if (auth()->user()->ratings[$i]->course_id == $id) {
                $hasRated = true;
            }
           
        }
        for ($i=0; $i <count(auth()->user()->courses) ; $i++) { 
            if (auth()->user()->courses[$i]->id == $id) {
                $hasSubscribed = true;
            }
           
        }
        return view("course")->with(['id' => $id, 'course' => $course, 'language' => $lang, 'categories' => $course->categories,'rated' => $hasRated,'subscribed' => $hasSubscribed,'ratings' => $course->ratings]);
    }
    public function rate(Request $request,$lang,$id){
        DB::table('ratings')->insert(
            ['rating' => $request->rating, 'comment' => $request->comment, 'user_id' => auth()->user()->id, 'course_id' => $id]
        );
        return back();

    }
    public function subscribe($lang, $id){
        auth()->user()->courses()->attach($id);
        return back();
    }
    public function find()
    {
        $categories = Category::all();

        return view("find_courses")->with('categories', $categories);
    }

    public function findAll()
    {
        $all_courses = Course::all();
        $array_courses = null;

        for ($i = 0; $i < count($all_courses); $i++) {
            $array_courses[$i] = [
                'course' => $all_courses[$i],
                'language' => app()->getLocale(),
                'categories' => $all_courses[$i]->categories,
                'teacher' => User::find($all_courses[$i]->teacher_id),
            ];
        }

        return response(json_encode($array_courses, 200));
    }

    public function geolocalization($lang, $id, $location)
    {
        return view("./geo_leaflet/view/index")->with(['id' => $id, 'language' => $lang, 'location' => $location]);
    }

    public function create()
    {
        $categories = Category::all();

        return view("create_course")->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $name = $request->name . "." . $request->file('image')->extension();
        if (!is_null($request->location)) {
            $id = DB::table('courses')->insertGetId(
                ['name' => $request->name, 'image' => $name, 'description' => $request->description, 'price' => $request->price, 'location' => $request->location, 'teacher_id' => auth()->user()->id]
            );
        } else {
            $id = DB::table('courses')->insertGetId(
                ['name' => $request->name, 'image' => $name, 'description' => $request->description, 'price' => $request->price, 'teacher_id' => auth()->user()->id]
            );
        }
        $course = Course::find($id);
        $request->file('image')->move(public_path('images'), $name);
        $arrayCategorias = explode(";", $request->categories);

        for ($i = 0; $i < count($arrayCategorias) - 1; $i++) {
            $course->categories()->attach($arrayCategorias[$i]);
        }
        return back();
    }

    public function delete($lang, $id)
    {
        $course = Course::find($id);
        $image_path = public_path() . '/images' . '/' . $course->image;
        unlink($image_path);
        $course->delete();
        return redirect()->to(route('admin', $lang));
    }
}
