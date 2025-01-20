<?php

namespace App\Http\Controllers;

use App\Models\Roles\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Checklist\Instructor;
use App\Models\Checklist\Course;
use App\Models\Checklist\Checklist;

class RegistrarController extends Controller
{
    public function dashboard()
    {
        return view("registrar.dashboard");
    }

    public function enrollmentLists()
    {
        $students = Student::with("program", "address", "user", "checklist.course", "checklist.instructor", "enrollment")->get();
        
        // You don't need to flatten the checklist, just pass the students
        $instructors = Instructor::all();
        $courses = Course::all();
    
        return view("registrar.enrollment-lists", compact('students', 'instructors', 'courses'));
    }
    


    public function cor()
    {
        $students = Student::with("program", "address", "user", "enrollment")->get();
        return view("registrar.cor", compact("students"));
    }

    public function recordStudents()
    {
        $students = Student::with("program", "address", "user")->get();
        return view("registrar.students-record", compact("students"));
    }

    public function checklist($student_id)
    {
        $student = Student::with('program', 'address', 'user')->findOrFail($student_id);
        $checklist = $student->checklist;
        $instructors = Instructor::orderBy('last_name')->orderBy('first_name')->get();

        return view('registrar.checklist', compact('student', 'checklist', 'instructors'));
    }


    public function updateChecklist(Request $request, $student_number)
    {
        $student = Student::where('student_number', $student_number)->firstOrFail();

        foreach ($student->checklist as $item) {
            $course_code = $item->course_code;

            // Prepare update data
            $updateData = [];

            if ($request->has("grades.$course_code")) {
                $updateData['grade'] = $request->input("grades.$course_code");
            }

            if ($request->has("instructor_ids.$course_code")) {
                $instructor_id = $request->input("instructor_ids.$course_code");
                if ($instructor_id) {
                    $updateData['instructor_id'] = $instructor_id;
                }
            }
            
            

            // Only update if there's data to change
            if (!empty($updateData)) {
                Checklist::where('student_number', $student_number)
                    ->where('course_code', $course_code)
                    ->update($updateData);
            }
        }

        return redirect()->route('registrar.checklist', ['student_number' => $student_number])
            ->with('success', 'Checklist updated successfully!');
    }

    public function showCOR()
    {
        // Get student with related data
        $student = Student::where('student_number', Auth::user()->id)
            ->first();

        if (!$student) {
            abort(404, 'Student not found.');
        }

        // Mappings
        $yearMapping = [
            'First Year' => 1,
            'Second Year' => 2,
            'Third Year' => 3,
            'Fourth Year' => 4,
        ];

        $semesterMapping = [
            'First Semester' => 1,
            'Second Semester' => 2,
            'Midyear' => 3,
        ];

        // Filter checklist with grades and instructor
        $checklistWithGrades = $student->checklist->filter(function ($item) {
            return $item->grade && $item->instructor;
        });

        if ($checklistWithGrades->isEmpty()) {
            $nextYearLevelString = "First Year";
            $nextSemesterString = "First Semester";
        } else {
            // Get highest year and semester
            $highestYear = $checklistWithGrades->max('year');
            $highestSemester = $checklistWithGrades->where('year', $highestYear)->max('semester');

            $nextYearLevel = ($highestSemester < 2) ? $yearMapping[$highestYear] : $yearMapping[$highestYear] + 1;
            $nextSemester = ($highestSemester < 2) ? $highestSemester + 1 : 1;

            $nextYearLevelString = array_search($nextYearLevel, $yearMapping) ?: "First Year";
            $nextSemesterString = array_search($nextSemester, $semesterMapping) ?: "First Semester";
        }

        // Get next courses
        $nextCourses = $student->checklist->filter(function ($item) use ($nextYearLevelString, $nextSemesterString) {
            return $item->year == $nextYearLevelString && $item->semester == $nextSemesterString && $item->course;
        });


        $student->enrollment()->latest()->first()->update([
            'status' => 'enrolled',
        ]);

        // Calculate total units
        $totalUnits = $nextCourses->sum(function ($course) {
            return ($course->course->credit_unit_lecture ?? 0) + ($course->course->credit_unit_laboratory ?? 0);
        });

        // Calculate total hours
        $totalHours = $nextCourses->sum(function ($course) {
            return ($course->course->contact_hours_lecture ?? 0) + ($course->course->contact_hours_laboratory ?? 0);
        });

        $latestEnrollment = $student->enrollment()->latest()->first();

        return view('student.enrollment-eval.cor', compact('student', 'nextCourses', 'nextYearLevelString', 'nextSemesterString', 'latestEnrollment', 'totalUnits', 'totalHours'));
    }
    
}
