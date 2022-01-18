<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;

class CourseController extends Controller
{
    public function course()
    {
        return view("course");
    }

    public function find()
    {
        return view("find_courses");
    }

    public function create()
    {   
        $categories = Category::all();
        return view("create_course")->with('categories', $categories);
    }
    public function store(Request $request){
        
        $name = $request->name  ."." . $request->file('image')->extension();
        if (!is_null($request->location)) {
            $id =  DB::table('courses')->insertGetId(
                ['name' => $request->name, 'image' => $name, 'description' => $request->description, 'price' => $request->price,'location' => $request->location,'teacher_id' => auth()->user()->id]
            );
        }
        else{
             $id = DB::table('courses')->insertGetId(
                ['name' => $request->name, 'image' => $name, 'description' => $request->description, 'price' => $request->price, 'teacher_id' => auth()->user()->id]
            );
           
        }
        $course = Course::find($id);
        $request->file('image')->move(public_path('images'), $name);
        $arrayCategorias = explode(";", $request->categories);
        for ($i=0; $i <count($arrayCategorias)-1 ; $i++) { 
          $course->categories()->attach($arrayCategorias[$i]);
        }
        return back();
    }
}
