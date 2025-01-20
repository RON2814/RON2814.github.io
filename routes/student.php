<?php

use App\Http\Controllers\StudentController;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Support\Facades\Route;

// Student Authentication / Routes
Route::middleware(['auth', 'verified', RoleMiddleware::class . ':student'])->name('student.')->group(function () {
    // STUDENT Dashboard
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');

    // Student Information Route
    Route::get('/student-information', [StudentController::class, 'studentInformation'])->name('student-information');

    // Enrolled Subjects Route
    Route::get('/enrolled-sub', function () {
        return view('student.enrolled-sub');
    })->name('enrolled-sub');

    // Class Schedule Route
    Route::get('/schedule', function () {
        return view('student.schedule');
    })->name('schedule');

    // Student Grades Route
    Route::get('/grades', [StudentController::class, 'studentGrades'])->name('student-grades');

    // Student Checklist Routes
    Route::get('/checklist/student-checklist', [StudentController::class, 'studentViewChecklist'])->name('student-checklist');

    // Enrollment Module Route
    Route::get('/enrollment', [StudentController::class, 'enrollmentModule'])->name('enrollment');

    // Enrollment - Check student classification and enrollment status
    Route::get('/enrollment/check-status', [StudentController::class, 'checkStatus'])->name('enrollment.check-status');

    // Enrollment Evaluation - Evaluated Courses Route
    Route::get('/enrollment-eval/evaluated-courses', [StudentController::class, 'evaluatedCourses'])->name('enrollment-eval.evaluated-courses');

    // Enrollment Evaluation - Under Review Route
    Route::get('/enrollment-eval/under-review', function () {
        return view('student.enrollment-eval.under-review');
    })->name('enrollment-eval.under-review');



    // Enrollment Evaluation - COR Route
    Route::get('/enrollment-eval/cor', [StudentController::class, 'showCOR'])->name('enrollment-eval.cor');
});
