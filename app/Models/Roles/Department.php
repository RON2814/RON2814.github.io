<?php

namespace App\Models\Roles;

use App\Models\Program;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $primaryKey = 'department_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'department_id',
        'last_name',
        'first_name',
        'middle_name',
        'extension_name',
        'contact_number',
        'program_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'department_id', 'id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id', 'id');
    }
}
