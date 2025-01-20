<?php

namespace App\Models\Checklist;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Instructor extends Model
{
    use HasFactory;

    protected $fillable = ['last_name', 'first_name', 'middle_name', 'email'];

}
