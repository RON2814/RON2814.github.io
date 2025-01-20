<?php

namespace App\Models;

use App\Models\Checklist\Enrollment;
use App\Models\Checklist\Instructor;
use App\Models\Roles\Student;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        "student_number",
        "section_name",
        "program_id",
        "current_student_enrolled",
        "max_capacity",
    ];

    public function program()
    {
        return $this->belongsTo(Program::class, "program_id", "id");
    }

    public function enrollent()
    {
        return $this->hasMany(Enrollment::class, "section_id", "id");
    }
}
