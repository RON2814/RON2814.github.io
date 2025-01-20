<?php

namespace App\Http\Controllers;

use App\Models\Roles\Student;
use App\Models\Checklist\Instructor;
use App\Models\Checklist\Course;
use App\Models\Program;
use Illuminate\Http\Request;

class EvaluationController extends Controller
{
    /**
     * Display the student evaluation page with student data.
     *
     * @return \Illuminate\View\View
     */

    public function advising()
    {
        // Fetch students who have an enrollment with 'under evaluation' status and related submitted data
        $students = Student::with([
            'program',
            'address',
            'user',
            'checklist.course',  // Fetch associated courses
            'checklist.instructor',  // Fetch associated instructors
            'enrollment'  // Fetch enrollment details
        ])
            ->whereHas('enrollment', function ($query) {
                $query->where('status', 'under evaluation');
            })
            ->get();

        // Get all checklists for the filtered students
        $checklist = $students->flatMap->checklist; // Flatten to a single collection

        // Filter the checklist to include only submitted courses (those with grades and instructors)
        $submittedChecklist = $checklist->filter(function ($item) {
            return !is_null($item->grade) && !is_null($item->instructor);
        });
        

        // Get the list of instructors (you can filter if needed)
        $instructors = Instructor::all();

        // Get course codes from the submitted checklist
        $courseCodes = $submittedChecklist->pluck('course_code')->toArray();

        // Fetch courses based on the submitted course codes
        $courses = Course::whereIn('course_code', $courseCodes)->get();

        // Return the view with the necessary data
        return view('department.advising', compact('students', 'submittedChecklist', 'instructors', 'courses'));
    }
}
