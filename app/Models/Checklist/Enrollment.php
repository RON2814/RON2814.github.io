<?php

namespace App\Models\Checklist;

use App\Models\Roles\Registrar;
use App\Models\Roles\Student;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        "student_number",
        "section_id",
        "year_level",
        "semester",
        "school_year_start",
        "school_year_end",
        "status",
        "registrar_encoder_id",
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, "student_number", "student_number");
    }

    public function section()
    {
        return $this->belongsTo(Section::class, "section_id", "id");
    }

    public function registrar()
    {
        return $this->belongsTo(Registrar::class, "registrar_encoder_id", "registrar_id");
    }

    public function checklist()
    {
        return $this->hasMany(Checklist::class, "enrollment_id", "id");
    }
}
