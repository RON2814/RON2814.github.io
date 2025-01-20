<?php

namespace App\Http\Controllers\ManageUsers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Checklist\Checklist;
use App\Models\Roles\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManageStudentController extends Controller
{
  // public function filter(Request $request)
  // {
  //   $programId = $request->input('program_id');
  //   $query = Student::with('program', 'address', 'user');

  //   if ($programId && $programId != 'all') {
  //     $query->where('program_id', $programId);
  //   }

  //   $students = $query->paginate(10);

  //   return response()->json($students);
  // }

  public function search(Request $request)
  {
    $query = $request->input('query');
    $programId = $request->input('program_id');

    // Validate inputs
    $request->validate([
      'query' => 'nullable|string|max:255',
      'program_id' => 'nullable|integer|exists:programs,id',
    ]);

    // Fetch students with relationships
    $students = Student::with(['program', 'user', 'address'])
      ->when($query, function ($q) use ($query) {
        $q->where(function ($subQuery) use ($query) {
          $subQuery->where('student_number', 'LIKE', "%{$query}%")
            ->orWhere('first_name', 'LIKE', "%{$query}%")
            ->orWhere('last_name', 'LIKE', "%{$query}%")
            ->orWhereHas('user', function ($q2) use ($query) {
              $q2->where('email', 'LIKE', "%{$query}%");
            });
        });
      })
      ->when($programId, function ($q) use ($programId) {
        $q->where('program_id', $programId);
      })->latest()->get();

    return response()->json($students);
  }

  public function destroy($student_number)
  {
    $student = User::where("id", $student_number)->firstOrFail();
    if (!$student) {
      return response()->json([
        'success' => false,
        'message' => 'Student not found.'
      ], 404);
    }

    // Delete the student
    $student->delete();
    return response()->json([
      'success' => true,
      'message' => 'Student deleted successfully.'
    ]);
  }

  public function update(Request $request, $student_number)
  {
    $student = Student::where("student_number", $student_number)->firstOrFail();
    $request->validate([
      "student_number" => ["string", "max:15"],
      "password" => ["nullable", "string", "min:8"],
      "last_name" => ["required", "string", "max:50"],
      "first_name" => ["required", "string", "max:50"],
      "middle_name" => ["required", "string", "max:50"],
      "extension_name" => ["nullable", "string", "max:10"],
      "contact_number" => ["nullable", "regex:/^(09|\+639)\d{9}$/"],
      "email" => ["nullable", "email", "max:50"],
      "program_id" => ["required", "exists:programs,id"],
      "classification" => ["required", "in:regular,irregular,transferee,returnee,freshmen"],

      "birthday" => ["nullable", "date"],
      "sex" => ["nullable", "in:male,female"],

      "house_number" => ["nullable", "string", "max:50"],
      "street" => ["nullable", "string", "max:50"],
      "barangay" => ["nullable", "string", "max:50"],
      "city" => ["nullable", "string", "max:50"],
      "province" => ["nullable", "string", "max:50"],
      "zip_code" => ["nullable", "string", "max:10"],
    ], [
      'contact_number.regex' => 'The contact number must be a valid Philippine phone number, starting with either +63 or 0.',
    ]);

    $student->update([
      "last_name" => $request->last_name,
      "first_name" => $request->first_name,
      "middle_name" => $request->middle_name,
      "extension_name" => $request->extension_name,
      "contact_number" => $request->contact_number,
      "program_id" => $request->program_id,
      "classification" => $request->classification,
      "birthday" => $request->birthday,
      "sex" => $request->sex,
    ]);

    $address = $student->address;
    $address->update([
      "house_number" => $request->house_number,
      "street" => $request->street,
      "barangay" => $request->barangay,
      "city" => $request->city,
      "province" => $request->province,
      "zip_code" => $request->zip_code,
    ]);

    $user = $student->user;
    $user->update([
      "name" => $request->first_name . ' ' . $request->last_name,
      "email" => $request->email,
    ]);

    if ($request->password) {
      $user->update([
        "password" => bcrypt($request->password),
      ]);
    }
    if (Auth::user()->role_id == 3) {
      return redirect()->route('registrar.enrollment-lists')->with('success', 'Student updated successfully.');
    }
    return redirect()->route('admin.manageUsers.student')->with('success', 'Student updated successfully.');
  }

  public function store(Request $request)
  {
    $request->validate([
      "student_number" => ["required", "string", "max:15", "unique:students,student_number", "unique:users,id"],
      "password" => ["required", "string", "min:8"],
      "last_name" => ["required", "string", "max:50"],
      "first_name" => ["required", "string", "max:50"],
      "middle_name" => ["required", "string", "max:50"],
      "extension_name" => ["nullable", "string", "max:50"],
      "contact_number" => ["nullable", "regex:/^(09|\+639)\d{9}$/"],
      "email" => ["nullable", "email", "max:50", "unique:users,email"],
      "program_id" => ["required", "exists:programs,id"],
      "classification" => ["required", "in:regular,irregular,transferee,returnee,freshmen"],

      "birthday" => ["nullable", "date"],
      "sex" => ["nullable", "in:male,female"],

      "house_number" => ["nullable", "string", "max:50"],
      "street" => ["nullable", "string", "max:50"],
      "barangay" => ["nullable", "string", "max:50"],
      "city" => ["nullable", "string", "max:50"],
      "province" => ["nullable", "string", "max:50"],
      "zip_code" => ["nullable", "string", "max:10"],
    ], [
      'contact_number.regex' => 'The contact number must be a valid Philippine phone number, starting with either +63 or 0.',
    ]);

    $address = Address::create([
      "house_number" => $request->house_number,
      "street" => $request->street,
      "barangay" => $request->barangay,
      "city" => $request->city,
      "province" => $request->province,
      "zip_code" => $request->zip_code,
    ]);

    User::create([
      "id" => $request->student_number,
      "name" => "{$request->last_name}, {$request->first_name} {$request->middle_name}",
      "email" => $request->email,
      "password" => bcrypt($request->password),
      "role_id" => 1, // Student role
    ]);

    $student = Student::create([
      "student_number" => $request->student_number,
      "last_name" => $request->last_name,
      "first_name" => $request->first_name,
      "middle_name" => $request->middle_name,
      "extension_name" => $request->extension_name,
      "contact_number" => $request->contact_number,
      "program_id" => $request->program_id,
      "classification" => $request->classification === 'freshmen' ? 'Regular' : $request->classification,
      "address_id" => $address->id,
      "birthday" => $request->birthday,
      "sex" => $request->sex,
    ]);

    // Set enrollment status to 'Pending' for all classifications except 'freshmen'
    $status = $request->classification === 'freshmen' ? 'Enrolled' : 'Pending';

    $enrolled = $student->enrollment()->create([
      'year_level' => 'First Year',
      'semester' => 'First Semester',
      'school_year_start' => date('Y'),
      'school_year_end' => date('Y') + 1,
      'status' => $status, // Set status to 'Pending' or 'Enrolled' based on classification
    ]);

    

    // Create checklist for the new student
    $checklistItems = $request->program_id == 1 /* Program ID 1 is BSCS */ ? [
      ['course_code' => 'GNED 02', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'GNED 05', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'GNED 11', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'COSC 50', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'DCIT 21', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'DCIT 22', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'FITT 1', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'NSTP 1', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'CvSU 101', 'year' => "First Year", 'semester' => "First Semester"],

      ['course_code' => 'GNED 01', 'year' => "First Year", 'semester' => "Second Semester"],
      ['course_code' => 'GNED 03', 'year' => "First Year", 'semester' => "Second Semester"],
      ['course_code' => 'GNED 06', 'year' => "First Year", 'semester' => "Second Semester"],
      ['course_code' => 'GNED 12', 'year' => "First Year", 'semester' => "Second Semester"],
      ['course_code' => 'DCIT 23', 'year' => "First Year", 'semester' => "Second Semester"],
      ['course_code' => 'ITEC 50', 'year' => "First Year", 'semester' => "Second Semester"],
      ['course_code' => 'FITT 2', 'year' => "First Year", 'semester' => "Second Semester"],
      ['course_code' => 'NSTP 2', 'year' => "First Year", 'semester' => "Second Semester"],

      ['course_code' => 'GNED 04', 'year' => "Second Year", 'semester' => "First Semester"],
      ['course_code' => 'MATH 1', 'year' => "Second Year", 'semester' => "First Semester"],
      ['course_code' => 'COSC 55', 'year' => "Second Year", 'semester' => "First Semester"],
      ['course_code' => 'COSC 60', 'year' => "Second Year", 'semester' => "First Semester"],
      ['course_code' => 'DCIT 50', 'year' => "Second Year", 'semester' => "First Semester"],
      ['course_code' => 'DCIT 24', 'year' => "Second Year", 'semester' => "First Semester"],
      ['course_code' => 'INSY 50', 'year' => "Second Year", 'semester' => "First Semester"],
      ['course_code' => 'FITT 3', 'year' => "Second Year", 'semester' => "First Semester"],

      ['course_code' => 'GNED 08', 'year' => "Second Year", 'semester' => "Second Semester"],
      ['course_code' => 'GNED 14', 'year' => "Second Year", 'semester' => "Second Semester"],
      ['course_code' => 'MATH 2', 'year' => "Second Year", 'semester' => "Second Semester"],
      ['course_code' => 'COSC 65', 'year' => "Second Year", 'semester' => "Second Semester"],
      ['course_code' => 'COSC 70', 'year' => "Second Year", 'semester' => "Second Semester"],
      ['course_code' => 'DCIT 25', 'year' => "Second Year", 'semester' => "Second Semester"],
      ['course_code' => 'DCIT 55', 'year' => "Second Year", 'semester' => "Second Semester"],
      ['course_code' => 'FITT 4', 'year' => "Second Year", 'semester' => "Second Semester"],

      ['course_code' => 'MATH 3', 'year' => "Third Year", 'semester' => "First Semester"],
      ['course_code' => 'COSC 75', 'year' => "Third Year", 'semester' => "First Semester"],
      ['course_code' => 'COSC 80', 'year' => "Third Year", 'semester' => "First Semester"],
      ['course_code' => 'COSC 85', 'year' => "Third Year", 'semester' => "First Semester"],
      ['course_code' => 'COSC 101', 'year' => "Third Year", 'semester' => "First Semester"],
      ['course_code' => 'DCIT 26', 'year' => "Third Year", 'semester' => "First Semester"],
      ['course_code' => 'DCIT 65', 'year' => "Third Year", 'semester' => "First Semester"],

      ['course_code' => 'GNED 09', 'year' => "Third Year", 'semester' => "Second Semester"],
      ['course_code' => 'MATH 4', 'year' => "Third Year", 'semester' => "Second Semester"],
      ['course_code' => 'COSC 90', 'year' => "Third Year", 'semester' => "Second Semester"],
      ['course_code' => 'COSC 95', 'year' => "Third Year", 'semester' => "Second Semester"],
      ['course_code' => 'COSC 106', 'year' => "Third Year", 'semester' => "Second Semester"],
      ['course_code' => 'DCIT 60', 'year' => "Third Year", 'semester' => "Second Semester"],
      ['course_code' => 'ITEC 85', 'year' => "Third Year", 'semester' => "Second Semester"],

      ['course_code' => 'COSC 199', 'year' => "Third Year", 'semester' => "Midyear"],

      ['course_code' => 'ITEC 80', 'year' => "Fourth Year", 'semester' => "First Semester"],
      ['course_code' => 'COSC 100', 'year' => "Fourth Year", 'semester' => "First Semester"],
      ['course_code' => 'COSC 105', 'year' => "Fourth Year", 'semester' => "First Semester"],
      ['course_code' => 'COSC 111', 'year' => "Fourth Year", 'semester' => "First Semester"],
      ['course_code' => 'COSC 200A', 'year' => "Fourth Year", 'semester' => "First Semester"],

      ['course_code' => 'GNED 07', 'year' => "Fourth Year", 'semester' => "Second Semester"],
      ['course_code' => 'GNED 10', 'year' => "Fourth Year", 'semester' => "Second Semester"],
      ['course_code' => 'COSC 110', 'year' => "Fourth Year", 'semester' => "Second Semester"],
      ['course_code' => 'COSC 200B', 'year' => "Fourth Year", 'semester' => "Second Semester"],

    ] : [ // Program ID 2 is BSIT
      ['course_code' => 'GNED 02', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'GNED 05', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'GNED 11', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'COSC 50', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'DCIT 21', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'DCIT 22', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'FITT 1', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'NSTP 1', 'year' => "First Year", 'semester' => "First Semester"],
      ['course_code' => 'CvSU 101', 'year' => "First Year", 'semester' => "First Semester"],

      ['course_code' => 'GNED 01', 'year' => "First Year", 'semester' => "Second Semester"],
      ['course_code' => 'GNED 03', 'year' => "First Year", 'semester' => "Second Semester"],
      ['course_code' => 'GNED 06', 'year' => "First Year", 'semester' => "Second Semester"],
      ['course_code' => 'GNED 12', 'year' => "First Year", 'semester' => "Second Semester"],
      ['course_code' => 'DCIT 23', 'year' => "First Year", 'semester' => "Second Semester"],
      ['course_code' => 'ITEC 50', 'year' => "First Year", 'semester' => "Second Semester"],
      ['course_code' => 'FITT 2', 'year' => "First Year", 'semester' => "Second Semester"],
      ['course_code' => 'NSTP 2', 'year' => "First Year", 'semester' => "Second Semester"],

      ['course_code' => 'GNED 04', 'year' => "Second Year", 'semester' => "First Semester"],
      ['course_code' => 'GNED 07', 'year' => "Second Year", 'semester' => "First Semester"],
      ['course_code' => 'GNED 10', 'year' => "Second Year", 'semester' => "First Semester"],
      ['course_code' => 'GNED 14', 'year' => "Second Year", 'semester' => "First Semester"],
      ['course_code' => 'ITEC 55', 'year' => "Second Year", 'semester' => "First Semester"],
      ['course_code' => 'DCIT 24', 'year' => "Second Year", 'semester' => "First Semester"],
      ['course_code' => 'DCIT 50', 'year' => "Second Year", 'semester' => "First Semester"],
      ['course_code' => 'FITT 3', 'year' => "Second Year", 'semester' => "First Semester"],

      ['course_code' => 'GNED 08', 'year' => "Second Year", 'semester' => "Second Semester"],
      ['course_code' => 'DCIT 25', 'year' => "Second Year", 'semester' => "Second Semester"],
      ['course_code' => 'ITEC 60', 'year' => "Second Year", 'semester' => "Second Semester"],
      ['course_code' => 'ITEC 65', 'year' => "Second Year", 'semester' => "Second Semester"],
      ['course_code' => 'DCIT 55', 'year' => "Second Year", 'semester' => "Second Semester"],
      ['course_code' => 'ITEC 70', 'year' => "Second Year", 'semester' => "Second Semester"],
      ['course_code' => 'FITT 4', 'year' => "Second Year", 'semester' => "Second Semester"],

      ['course_code' => 'STAT 2', 'year' => "Second Year", 'semester' => "Midyear"],
      ['course_code' => 'ITEC 75', 'year' => "Second Year", 'semester' => "Midyear"],

      ['course_code' => 'ITEC 80', 'year' => "Third Year", 'semester' => "First Semester"],
      ['course_code' => 'ITEC 85', 'year' => "Third Year", 'semester' => "First Semester"],
      ['course_code' => 'ITEC 90', 'year' => "Third Year", 'semester' => "First Semester"],
      ['course_code' => 'INSY 55', 'year' => "Third Year", 'semester' => "First Semester"],
      ['course_code' => 'DCIT 26', 'year' => "Third Year", 'semester' => "First Semester"],
      ['course_code' => 'DCIT 60', 'year' => "Third Year", 'semester' => "First Semester"],

      ['course_code' => 'GNED 09', 'year' => "Third Year", 'semester' => "Second Semester"],
      ['course_code' => 'ITEC 95', 'year' => "Third Year", 'semester' => "Second Semester"],
      ['course_code' => 'ITEC 101', 'year' => "Third Year", 'semester' => "Second Semester"],
      ['course_code' => 'ITEC 106', 'year' => "Third Year", 'semester' => "Second Semester"],
      ['course_code' => 'ITEC 100', 'year' => "Third Year", 'semester' => "Second Semester"],
      ['course_code' => 'ITEC 105', 'year' => "Third Year", 'semester' => "Second Semester"],
      ['course_code' => 'ITEC 200A', 'year' => "Third Year", 'semester' => "Second Semester"],

      ['course_code' => 'DCIT 65', 'year' => "Fourth Year", 'semester' => "First Semester"],
      ['course_code' => 'ITEC 111', 'year' => "Fourth Year", 'semester' => "First Semester"],
      ['course_code' => 'ITEC 116', 'year' => "Fourth Year", 'semester' => "First Semester"],
      ['course_code' => 'ITEC 110', 'year' => "Fourth Year", 'semester' => "First Semester"],
      ['course_code' => 'ITEC 200B', 'year' => "Fourth Year", 'semester' => "First Semester"],

      ['course_code' => 'ITEC 199', 'year' => "Fourth Year", 'semester' => "Second Semester"],
    ];

    foreach ($checklistItems as $item) {
      $data = [
        'student_number' => $request->student_number,
        'course_code' => $item['course_code'],
        'year' => $item['year'],
        'semester' => $item['semester'],
      ];

      if (isset($enrolled) && $item['year'] === 'First Year' && $item['semester'] === 'First Semester') {
        $data['enrollment_id'] = $enrolled->id;
      }

      Checklist::create($data);
    }

    if (Auth::user()->role_id == 3) {
      return redirect()->route('registrar.enrollment-lists')->with('success', 'Student added successfully.');
    }

    return redirect()->route('admin.manageUsers.student')->with('success', 'Student added successfully.');
  }
}
