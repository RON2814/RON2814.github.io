<?php

namespace App\Http\Controllers;

use App\Models\Roles\Admin;
use App\Models\Roles\Department;
use App\Models\Roles\Registrar;
use App\Models\Roles\Student;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Admin Dashboard
    public function dashboard()
    {
        $users = User::all();

        return view('admin.dashboard', compact('users'));
    }

    public function manageStudent()
    {
        $students = Student::with("program", "address", "user")->latest()->paginate(15);

        return view('admin.manage-users.student', compact('students'));
    }

    public function filterStudents(Request $request)
    {
        $programId = $request->input('program_id');
        $query = Student::with('program', 'address', 'user');

        if ($programId && $programId != 'all') {
            $query->where('program_id', $programId);
        }

        $students = $query->get();

        return response()->json($students);
    }

    public function manageRegistrar()
    {
        $registrars = Registrar::with('user')->get();
        return view('admin.manage-users.registrar', compact('registrars'));
    }

    public function manageDepartment()
    {
        $departments = Department::with('user', 'program')->get();
        return view('admin.manage-users.department', compact('departments'));
    }

    public function manageAdmin()
    {
        $admins = Admin::with('user')->get();
        return view('admin.manage-users.admin', compact('admins'));
    }

}
