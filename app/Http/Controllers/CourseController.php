<?php

namespace App\Http\Controllers;

use App\Models\Checklist\Course;

class CourseController extends Controller
{
    public function showCourses()
    {
        $courses = Course::paginate(30);

        return view('department.courses', compact('courses'));
    }
}
