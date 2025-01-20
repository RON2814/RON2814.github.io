<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Checklist\Instructor;

class InstructorController extends Controller
{
    public function showInstructor(Request $request)
    {
        // If a search query is passed, filter instructors
        $search = $request->input('search');
        
        $instructors = Instructor::when($search, function ($query, $search) {
            return $query->where('first_name', 'like', "%{$search}%")
                         ->orWhere('last_name', 'like', "%{$search}%");
        })->paginate(20);
    
        return view('department.instructor', compact('instructors', 'search'));
    }
    

    public function schedule()
    {
        return view('department.schedule');
    }

    // Add Instructor method
    public function addInstructor(Request $request)
    {
        // Validate the form data
        $request->validate([
            'lastName' => 'required|string|max:255',
            'firstName' => 'required|string|max:255',
            'middleName' => 'nullable|string|max:255',
            'emailAdd' => 'required|email|unique:instructors,email|max:255',
        ]);

        // Create a new instructor record
        $instructor = new Instructor();
        $instructor->last_name = $request->lastName;
        $instructor->first_name = $request->firstName;
        $instructor->middle_name = $request->middleName;
        $instructor->email = $request->emailAdd;
        $instructor->save();

        // Redirect back with a success message
        return redirect()->route('department.instructor')->with('success', 'Instructor added successfully!');
    }

    // Update Instructor method
    public function updateInstructor(Request $request, $id)
    {
        // Find the instructor by ID, or fail with a 404 if not found
        $instructor = Instructor::findOrFail($id);
    
        // Validate the incoming data
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:instructors,email,' . $id, // Unique check for email
        ]);
    
        // Update the instructor's information
        $instructor->update([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'middle_name' => $validated['middle_name'],
            'email' => $validated['email'],
        ]);
    
        // Redirect back with a success message
        return redirect()->route('department.instructor')
            ->with('success', 'Instructor updated successfully!');
    }
    
    
}
