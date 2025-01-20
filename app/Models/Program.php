<?php

namespace App\Models;

use App\Models\Roles\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Checklist\Course;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public $timestamps = false;

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
