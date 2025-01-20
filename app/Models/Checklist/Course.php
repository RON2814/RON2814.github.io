<?php

namespace App\Models\Checklist;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Program;

class Course extends Model
{
    use HasFactory;

    public $timestamps = false; // Disable timestamps
    public $incrementing = false; // Disable auto-incrementing
    protected $keyType = 'string'; // Primary key is a string

    // Add fillable properties
    protected $fillable = [
        'course_code',
        'course_title',
        'credit_unit_lecture',
        'credit_unit_laboratory',
        'contact_hours_lecture',
        'contact_hours_laboratory',
        'pre_requisite',
    ];

    // Add relationships
    public function checklist()
    {
        return $this->belongsToMany(Checklist::class, 'checklist_courses', 'course_code', 'checklist_id');
    }
}
