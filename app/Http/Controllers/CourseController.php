<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CourseController extends Controller
{
    public function course($lang, $id)
    {
        $course = Course::find($id);
        $hasRated = false;
        $hasSubscribed = false;
        for ($i = 0; $i < count(auth()->user()->ratings); $i++) { 
            if (auth()->user()->ratings[$i]->course_id == $id) {
                $hasRated = true;
            }
        }
        for ($i = 0; $i < count(auth()->user()->courses); $i++) { 
            if (auth()->user()->courses[$i]->id == $id) {
                $hasSubscribed = true;
            }
        }
        return view("course")->with(['id' => $id, 'course' => $course, 'language' => $lang, 'categories' => $course->categories, 'rated' => $hasRated, 'subscribed' => $hasSubscribed, 'ratings' => $course->ratings]);
    }

    public function rate(Request $request, $lang, $id)
    {
        DB::table('ratings')->insert(
            ['rating' => $request->rating, 'comment' => $request->comment, 'user_id' => auth()->user()->id, 'course_id' => $id]
        );
        return back();
    }

    public function subscribe($lang, $id)
    {
        auth()->user()->courses()->attach($id);
        return back();
    }

    public function unsubscribe($lang, $id)
    {
        auth()->user()->courses()->detach($id);
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
                'ratings' => $all_courses[$i]->ratings,
                'user_courses' => auth()->user()->courses,
            ];
        }
        return response(json_encode($array_courses, 200));
    }

    public function geolocalization($lang, $id, $location)
    {
        return view("./Geo_leaflet/view/index")->with(['id' => $id, 'language' => $lang, 'location' => $location]);
    }

    public function create()
    {
        if (Gate::allows('access-creator')) {
            $categories = Category::all();
            return view("create_course")->with('categories', $categories);
        }
        abort(404);
    }

    public function store(Request $request)
    {
        if (Gate::allows('access-creator')) {
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
        abort(404);
        
    }

    public function delete($lang, $id)
    {
        $course = Course::find($id);
        $image_path = public_path() . '/images' . '/' . $course->image;
        unlink($image_path);
        $course->delete();

        if (auth()->user()->role_id == 3) {
            return redirect()->to(route('admin', $lang));
        }

        return redirect()->to(route('created_courses', $lang));
    }

    public function creatorCourses()
    {
        if (Gate::allows('access-creator')) {
            $courses = auth()->user()->course_teacher;
            return view("creator_courses")->with('courses', $courses);
        }
        abort(404);
    }

    public function editCourse($lang, $id)
    {
        if (Gate::allows('access-creator')) {
            $course = Course::find($id);
            $current_categories = $course->categories;
            $categories = Category::all();
            return view("edit_course")->with('course', $course)->with('categories', $categories)->with('current_categories', $current_categories);
        }
        abort(404);
    }

    public function modifyCourse($lang, Request $request)
    {
        if (Gate::allows('access-creator')) {
            $course_modify = Course::find($request->id);

        $course_modify->name = $request->name;
        $course_modify->description = $request->description;
        $course_modify->price = $request->price;
        
        if ($request->image != null) {
            $image_path = public_path() . '/images' . '/' . $course_modify->image;
            unlink($image_path);

            $name = $request->name . "." . $request->file('image')->extension();
            $course_modify->image = $name;
            
            $request->file('image')->move(public_path('images'), $name);
        }

        $arrayCategorias = explode(";", $request->categories);

        $course_modify->categories()->detach();
        for ($i = 0; $i < count($arrayCategorias) - 1; $i++) {
            $course_modify->categories()->attach($arrayCategorias[$i]);
        }

        if ($request->location != null && $request->location != "") {
            $course_modify->location = $request->location;
        }
        else {
            $course_modify->location = null;
        }

        $course_modify->save();

        return redirect()->to(route('created_courses', app()->getLocale()));
        }
        abort(404);
        
    }
}
