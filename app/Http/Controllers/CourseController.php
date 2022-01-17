<?php

namespace App\Http\Controllers;

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
        return view("create_course");
    }
}
