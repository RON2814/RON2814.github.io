<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $primaryKey = 'schedule_code';
    protected $fillable = ['schedule_code', 'course_code', 'start_time', 'end_time', 'day', 'room'];
}
