<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManageUsers\ManageAdminController;
use App\Http\Controllers\ManageUsers\ManageDepartmentController;
use App\Http\Controllers\ManageUsers\ManageRegistrarController;
use App\Http\Controllers\ManageUsers\ManageStudentController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

// Admin Manage Users Routes
Route::middleware(['auth', 'verified', RoleMiddleware::class . ':admin'])
  ->prefix('admin')
  ->name('admin.')
  ->group(function () {
    Route::get("/dashboard", [AdminController::class, 'dashboard'])->name("dashboard");
  });

Route::middleware(['auth', 'verified', RoleMiddleware::class . ':admin'])
  ->prefix('admin/manage-users')
  ->name('admin.manageUsers.')
  ->group(function () {
    Route::get('/student', [AdminController::class, 'manageStudent'])->name('student');
    Route::get('/registrar', [AdminController::class, 'manageRegistrar'])->name('registrar');
    Route::get('/department', [AdminController::class, 'manageDepartment'])->name('department');
    Route::get('/admin', [AdminController::class, 'manageAdmin'])->name('admin');

    // Add Student
    Route::post("/student/store", [ManageStudentController::class, 'store'])
      ->name("store-student");
    // Update Student
    Route::patch("/student/update/{student_number}", [ManageStudentController::class, 'update'])
      ->name("update-student");
    // Search Student
    Route::get('/student/search', [ManageStudentController::class, 'search'])
      ->name('search-student');
    // Delete Student
    Route::delete('/student/destroy/{student_number}', [ManageStudentController::class, 'destroy'])
      ->name('destroy-student');

    // Add Department
    Route::post("/department/store", [ManageDepartmentController::class, 'store'])
      ->name("store-department");
    // Update Department
    Route::patch("/department/update/{department_id}", [ManageDepartmentController::class, 'update'])
      ->name("update-department");
    // search Department
    Route::get('/department/search', [ManageDepartmentController::class, 'search'])
      ->name('search-department');
    // Delete Department
    Route::delete('/department/destroy/{department_id}', [ManageDepartmentController::class, 'destroy'])
      ->name('destroy-department');

    // Add Registrar
    Route::post("/registrar/store", [ManageRegistrarController::class, 'store'])
      ->name("store-registrar");
    // Update Registrar
    Route::patch("/registrar/update/{registrar_id}", [ManageRegistrarController::class, 'update'])
      ->name("update-registrar");
    // search Registrar
    Route::get('/registrar/search', [ManageRegistrarController::class, 'search'])
      ->name('search-registrar');
    // Delete Registrar
    Route::delete('/registrar/destroy/{registrar_id}', [ManageRegistrarController::class, 'destroy'])
      ->name('destroy-registrar');

    // Add Admin
    Route::post("/admin/store", [ManageAdminController::class, 'store'])
      ->name("store-admin");
    // Update Admin
    Route::patch("/admin/update/{admin_id}", [ManageAdminController::class, 'update'])
      ->name("update-admin");
    // search Admin
    Route::get('/admin/search', [ManageAdminController::class, 'search'])
      ->name('search-admin');
    // Delete Admin
    Route::delete('/admin/destroy/{admin_id}', [ManageAdminController::class, 'destroy'])
      ->name('destroy-admin');
  });