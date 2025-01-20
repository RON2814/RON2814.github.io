<?php

use App\Http\Controllers\ManageUsers\ManageStudentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', RoleMiddleware::class . ':registrar'])
  ->prefix('registrar')
  ->name('registrar.')
  ->group(function () {

    // Dashboard
    Route::get('/dashboard', [RegistrarController::class, "dashboard"])->name('dashboard');

    Route::get("/enrollment-lists", [RegistrarController::class, 'enrollmentLists'])->name("enrollment-lists");


    Route::post("/enrollment-lists/store", [ManageStudentController::class, 'store'])->name("enrollment-lists.store");

    Route::patch("/enrollment-lists/update/{student_id}", [ManageStudentController::class, 'update'])->name("enrollment-lists.update");
    Route::delete('/enrollment-lists/destroy/{student_number}', [ManageStudentController::class, 'destroy'])
      ->name('/enrollment-lists');

   
    // COR
    Route::get('/student/cor', [StudentController::class, 'showStudentCOR'])->name('student.cor');



    // Registrar routes
    Route::get('registrar/checklist/{student_number}', [RegistrarController::class, 'checklist'])->name('checklist');

    Route::patch('registrar/checklist/{student_number}', [RegistrarController::class, 'updateChecklist'])->name('registrar.checklist.update');


    Route::get("students-record", [RegistrarController::class, 'recordStudents'])->name("students-record");
  });
