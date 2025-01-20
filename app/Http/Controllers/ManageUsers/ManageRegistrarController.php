<?php

namespace App\Http\Controllers\ManageUsers;

use App\Http\Controllers\Controller;
use App\Models\Roles\Registrar;
use App\Models\User;
use Illuminate\Http\Request;

class ManageRegistrarController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Validate inputs
        $request->validate([
            'query' => 'nullable|string|max:255',
        ]);

        // Fetch students with relationships
        $registrar = Registrar::with('user')
            ->when($query, function ($q) use ($query) {
                $q->where(function ($subQuery) use ($query) {
                    $subQuery->where('registrar_id', 'LIKE', "%{$query}%")
                        ->orWhere('first_name', 'LIKE', "%{$query}%")
                        ->orWhere('last_name', 'LIKE', "%{$query}%");
                });
            })->latest()->get();

        return response()->json($registrar);
    }
    public function destroy($registrar_id)
    {
        $registrar = User::where("id", $registrar_id)->firstOrFail();
        if (!$registrar) {
            return response()->json([
                'success' => false,
                'message' => 'Student not found.'
            ], 404);
        }

        // Delete the registrar
        $registrar->delete();
        return response()->json([
            'success' => true,
            'message' => 'Student deleted successfully.'
        ]);
    }
    public function update(Request $request, $registrar_id)
    {
        $registrar = Registrar::findOrFail($registrar_id);
        $request->validate([
            'registrar_id' => ["string", "max:15"],
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

        $registrar->update([
            'registrar_id' => $request->registrar_id,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'extension_name' => $request->extension_name,
            'contact_number' => $request->contact_number,
            'program_id' => $request->program_id,
        ]);

        $user = $registrar->user;
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

        return redirect()->route('admin.manageUsers.registrar')->with('success', 'Registrar updated successfully');
    }
    public function store(Request $request)
    {
        $request->validate([
            'registrar_id' => ["required", "string", "max:15", "unique:registrars,registrar_id", "unique:users,id"],
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
            'id' => $request->registrar_id,
            'name' => "{$request->last_name}, {$request->first_name} {$request->middle_name}",
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => 3, // Registrar role
        ]);

        Registrar::create([
            'registrar_id' => $request->registrar_id,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'extension_name' => $request->extension_name,
            'contact_number' => $request->contact_number,
        ]);

        return redirect()->route('admin.manageUsers.registrar');
    }
}
