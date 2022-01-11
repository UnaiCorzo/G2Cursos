<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
