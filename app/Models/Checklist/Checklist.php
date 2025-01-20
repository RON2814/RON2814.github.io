<?php

namespace App\Models\Checklist;

use App\Models\Roles\Student;
use App\Models\Checklist\Course;
use App\Models\Checklist\Instructor;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    protected $table = "checklists";
    public $incrementing = false; // Important for non-auto-incrementing primary keys
    public $timestamps = false; // Disable timestamps if not needed

    protected $fillable = [
        "student_number",
        "course_code",
        "grade",
        "instructor_id",
        "year",
        "semester",
        "enrollment_id",
    ];

    // Override default primary key behavior
    public function getKeyName()
    {
        return ['student_number', 'course_code']; // Manually define composite key
    }

    public function getKey()
    {
        return ['student_number' => $this->student_number, 'course_code' => $this->course_code];
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_number', 'student_number');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_code', 'course_code');
    }

    public function instructor()
    {
        return $this->belongsTo(Instructor::class, 'instructor_id');
    }

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class, 'enrollment_id', 'id');
    }
}
