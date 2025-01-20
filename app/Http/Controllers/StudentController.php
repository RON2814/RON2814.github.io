<?php

namespace App\Http\Controllers;

use App\Models\Checklist\Checklist;
use App\Models\User; // Change to App\Models\Student if using a Student model
use App\Models\Roles\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * Login a student
     */
    public function loginStudent(Request $request)
    {
        $validatedData = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required',
        ]);

        if (Auth::attempt(['student_id' => $validatedData['loginname'], 'password' => $validatedData['loginpassword']])) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors(['loginname' => 'Invalid credentials.'])->onlyInput('loginname');
    }

    /**
     * Register a new student
     */
    public function registerStudent(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:20', Rule::unique('users', 'name')],
            'student_id' => ['required', 'string', 'unique:users,student_id', 'min:6', 'max:20'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8', 'max:200'],
        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);

        Auth::login($user);

        return redirect('/dashboard');
    }

    /**
     * Logout the current student
     */
    public function logoutStudent(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function index()
    {
        $student = Student::with(['address', 'program', 'checklist'])
            ->where('student_number', Auth::user()->id)
            ->first();

        if (!$student) {
            abort(404, 'Student information not found.');
        }

        return view('student.dashboard', compact('student'));
    }

    /**
     * Show student information
     */
    public function studentInformation()
    {
        $student = Student::where('student_number', Auth::user()->id)
            ->first();

        if (!$student) {
            abort(404, 'Student information not found.');
        }

        return view('student.student-information', compact('student'));
    }

    /**
     * Show student grades
     */
    public function studentGrades(Request $request)
    {
        $student = Student::with(['checklist'])
            ->where('student_number', Auth::user()->id)
            ->first();

        if (!$student) {
            abort(404, 'Student grades not found.');
        }

        $checklistQuery = $student->checklist();

        // Apply filters to the query
        if ($request->has('school_year')) {
            $checklistQuery->where('year', $request->school_year);
        }

        if ($request->has('semester')) {
            $checklistQuery->where('semester', $request->semester);
        }

        // Apply pagination
        $filteredChecklist = $checklistQuery->paginate(10); // Adjust the number per page as needed

        $yearLevels = $student->checklist->pluck('year')->unique();
        $semesters = $student->checklist->pluck('semester')->unique()->sortBy(function ($semester) {
            return $semester == 'First Semester' ? 0 : 1;
        });

        return view('student.student-grades', compact('student', 'yearLevels', 'semesters', 'filteredChecklist'));
    }


    /**
     * Show the Checklist page
     */
    public function studentViewChecklist(Request $request)
    {
        $student = Student::with(['checklist'])
            ->where('student_number', Auth::user()->id)
            ->first();

        if (!$student) {
            abort(404, 'Student information not found.');
        }

        // Retrieve the checklist and filter based on year and semester if provided in the request
        $checklist = $student->checklist;

        // Filter by year and semester if parameters are passed
        if ($request->has('year')) {
            $checklist = $checklist->where('year', $request->year);
        }

        if ($request->has('semester')) {
            $checklist = $checklist->where('semester', $request->semester);
        }

        // Pass the filtered checklist and other necessary data to the view
        return view('student.checklist.student-checklist', compact('student', 'checklist'));
    }


    /**
     * Show the enrollment module
     */
    /**
     * Show the enrollment module
     */
    public function enrollmentModule(Request $request)
    {
        // Fetch the current student
        $student = Student::where('student_number', Auth::user()->id)->first();

        if (!$student) {
            abort(404, 'Student information not found.');
        }

        // Filter checklist for items that have grades and an instructor
        $checklistWithGrades = $student->checklist->filter(function ($checklist) {
            return !is_null($checklist->grade) && !is_null($checklist->instructor);
        });

        // Get the highest year level and semester
        $highestYearLevel = $checklistWithGrades->max('year');
        $highestSemester = $checklistWithGrades->where('year', $highestYearLevel)->max('semester');

        // Filter the checklist to only include courses for the highest year level and semester
        $filteredChecklist = $checklistWithGrades->filter(function ($checklist) use ($highestYearLevel, $highestSemester) {
            return $checklist->year == $highestYearLevel && $checklist->semester == $highestSemester;
        });

        // Check for grade discrepancies
        $hasDiscrepancy = $filteredChecklist->contains(function ($checklist) {
            return in_array($checklist->grade, ['4.00', '5.00', 'INC', 'DROPPED']);
        });

        // Determine the evaluation status
        $evaluationStatus = 'UNDER REVIEW';
        if (!$hasDiscrepancy && strtoupper($student->classification) === 'REGULAR') {
            $evaluationStatus = 'PROCEED';
        }

        // Check if the student has an existing enrollment
        $latestEnrollment = $student->enrollment()->latest()->first();

        if (!$latestEnrollment) {
            // If no enrollment exists, create a new one and show the enrollment page first
            $student->enrollment()->create([
                'year_level' => $highestYearLevel,
                'semester' => $highestSemester,
                'school_year_start' => date('Y'),
                'school_year_end' => date('Y') + 1,
                'status' => 'pending',
            ]);

            return view('student.enrollment', compact('student', 'filteredChecklist', 'highestYearLevel', 'highestSemester', 'evaluationStatus'));
        }

        // If an enrollment exists and is still in 'pending' or 'enrolled' state, show the enrollment page first
        if ($latestEnrollment->status === 'pending' || $latestEnrollment->status === 'enrolled') {
            // Update the status to 'under evaluation'
            $latestEnrollment->update(['status' => 'under evaluation']);
            return view('student.enrollment', compact('student', 'filteredChecklist', 'highestYearLevel', 'highestSemester', 'evaluationStatus'));
        }

        // If enrollment has been evaluated, redirect to evaluated courses
        return redirect()->route('student.enrollment-eval.evaluated-courses');
    }



    public function evaluatedCourses(Request $request)
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

        $latestEnrollment = $student->enrollment()->latest()->first();

        if ($latestEnrollment && $latestEnrollment->status === 'enrolled' && $latestEnrollment->semester === $nextSemesterString && $latestEnrollment->year_level === $nextYearLevelString) {
            return redirect()->route('student.enrollment-eval.cor');
        } else {
            // Create a new enrollment record
            $enrollment = $student->enrollment()->create([
                'year_level' => $nextYearLevelString,
                'semester' => $nextSemesterString,
                'school_year_start' => date('Y'),
                'school_year_end' => date('Y') + 1,
                'status' => 'pending',
            ]);

            foreach ($nextCourses as $course) {
                // Use 'course_code' if 'id' doesn't exist
                Checklist::where('course_code', $course->course_code)->update([
                    'enrollment_id' => $enrollment->id,
                ]);
            }
        }


        return view('student.enrollment-eval.evaluated-courses', compact('student', 'nextCourses', 'nextYearLevelString', 'nextSemesterString'));
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
