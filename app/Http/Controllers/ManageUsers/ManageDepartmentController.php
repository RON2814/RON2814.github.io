<?php

namespace App\Http\Controllers\ManageUsers;

use App\Http\Controllers\Controller;
use App\Models\Roles\Department;
use App\Models\User;
use Illuminate\Http\Request;

class ManageDepartmentController extends Controller
{
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
        $depts = Department::with(['program', 'user'])
            ->when($query, function ($q) use ($query) {
                $q->where(function ($subQuery) use ($query) {
                    $subQuery->where('department_id', 'LIKE', "%{$query}%")
                        ->orWhere('first_name', 'LIKE', "%{$query}%")
                        ->orWhere('last_name', 'LIKE', "%{$query}%");
                });
            })
            ->when($programId, function ($q) use ($programId) {
                $q->where('program_id', $programId);
            })->latest()->get();

        return response()->json($depts);
    }
    public function destroy($department_id)
    {
        $dept = User::where("id", $department_id)->firstOrFail();
        if (!$dept) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.'
            ], 404);
        }

        // Delete the department
        $dept->delete();
        return response()->json([
            'success' => true,
            'message' => 'Student deleted successfully.'
        ]);
    }
    public function update(Request $request, $department_id)
    {
        $dept = Department::findOrFail($department_id);
        $request->validate([
            'department_id' => ["string", "max:15"],
            'password' => ["nullable", "string", "min:8"],
            'last_name' => ["required", "string", "max:50"],
            'first_name' => ["required", "string", "max:50"],
            'middle_name' => ["required", "string", "max:50"],
            'extension_name' => ["nullable", "string", "max:10"],
            'contact_number' => ['nullable', "regex:/^(09|\+639)\d{9}$/"],
            'program_id' => 'required',
            'email' => ["required", "email", "max:50"],
        ], [
            'contact_number.regex' => 'The contact number must be a valid Philippine phone number, starting with either +63 or 0.',
        ]);

        $dept->update([
            'department_id' => $request->department_id,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'extension_name' => $request->extension_name,
            'contact_number' => $request->contact_number,
            'program_id' => $request->program_id,
        ]);

        $user = $dept->user;
        $user->update([
            "name" => $request->first_name . ' ' . $request->last_name,
        ]);

        if ($request->email && $request->email !== $user->email) {
            $request->validate([
                'email' => 'unique:users,email',
            ]);
            $user->email = $request->email;
            $user->save();
        }

        if ($request->password) {
            $user->update([
                "password" => bcrypt($request->password),
            ]);
        }

        return redirect()->route('admin.manageUsers.department')->with('success', 'Department updated successfully');
    }
    public function store(Request $request)
    {
        $request->validate([
            'department_id' => ["required", "string", "max:15", "unique:departments,department_id", "unique:users,id"],
            'password' => ["required", "string", "min:8"],
            'last_name' => ["required", "string", "max:50"],
            'first_name' => ["required", "string", "max:50"],
            'middle_name' => ["required", "string", "max:50"],
            'extension_name' => ["nullable", "string", "max:10"],
            "email" => ["required", "email", "max:50", "unique:users,email"],
            "contact_number" => ["nullable", "string", "max:15"],
            "program_id" => ["required", "exists:programs,id"],
        ], [
            'contact_number.regex' => 'The contact number must be a valid Philippine phone number, starting with either +63 or 0.',
        ]);

        User::create([
            'id' => $request->department_id,
            'name' => "{$request->last_name}, {$request->first_name} {$request->middle_name}",
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 2, // Department role
        ]);

        Department::create([
            'department_id' => $request->department_id,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'extension_name' => $request->extension_name,
            'contact_number' => $request->contact_number,
            'program_id' => $request->program_id,
        ]);

        return redirect()->route('admin.manageUsers.department');
    }
}
