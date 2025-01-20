<?php

namespace App\Http\Controllers\ManageUsers;

use App\Http\Controllers\Controller;
use App\Models\Roles\Admin;
use App\Models\User;
use Illuminate\Http\Request;

class ManageAdminController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Validate inputs
        $request->validate([
            'query' => 'nullable|string|max:255',
        ]);

        // Fetch students with relationships
        $admin = Admin::with('user')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($subQuery) use ($query) {
                    $subQuery->where('admin_id', 'LIKE', "%{$query}%")
                        ->orWhere('first_name', 'LIKE', "%{$query}%")
                        ->orWhere('last_name', 'LIKE', "%{$query}%");
                });
            })->latest()->get();

        return response()->json($admin);
    }
    public function destroy($admin_id)
    {
        $admin = User::where("id", $admin_id)->firstOrFail();
        if (!$admin) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.'
            ], 404);
        }

        // Delete the admin
        $admin->delete();
        return response()->json([
            'success' => true,
            'message' => 'Student deleted successfully.'
        ]);
    }
    public function update(Request $request, $admin_id)
    {
        $admin = Admin::findOrFail($admin_id);
        $request->validate([
            'admin_id' => ["string", "max:15"],
            'password' => ["nullable", "string", "min:8"],
            'last_name' => ["required", "string", "max:50"],
            'first_name' => ["required", "string", "max:50"],
            'middle_name' => ["required", "string", "max:50"],
            'extension_name' => ["nullable", "string", "max:10"],
            'contact_number' => ["nullable", "regex:/^(09|\+639)\d{9}$/"],
            'email' => ["required", "email", "max:50"],
        ], [
            'contact_number.regex' => 'The contact number must be a valid Philippine phone number, starting with either +63 or 0.',
        ]);

        $admin->update([
            'admin_id' => $request->admin_id,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'extension_name' => $request->extension_name,
            'contact_number' => $request->contact_number,
            'program_id' => $request->program_id,
        ]);

        $user = $admin->user;
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

        return redirect()->route('admin.manageUsers.admin')->with('success', 'Admin updated successfully');
    }
    public function store(Request $request)
    {
        $request->validate([
            'admin_id' => ["required", "string", "max:15", "unique:admins,admin_id", "unique:users,id"],
            'password' => ["required", "string", "min:8"],
            'last_name' => ["required", "string", "max:50"],
            'first_name' => ["required", "string", "max:50"],
            'middle_name' => ["required", "string", "max:50"],
            'extension_name' => ["nullable", "string", "max:10"],
            "email" => ["required", "email", "max:50", "unique:users,email"],
            'contact_number' => ["nullable", "regex:/^(09|\+639)\d{9}$/"],
        ], [
            'contact_number.regex' => 'The contact number must be a valid Philippine phone number, starting with either +63 or 0.',
        ]);

        User::create([
            'id' => $request->admin_id,
            'name' => "{$request->last_name}, {$request->first_name} {$request->middle_name}",
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 4, // Admin role
        ]);

        Admin::create([
            'admin_id' => $request->admin_id,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'extension_name' => $request->extension_name,
            'contact_number' => $request->contact_number,
        ]);

        return redirect()->route('admin.manageUsers.admin');
    }
}
