<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Roles\Admin;
use App\Models\Roles\Department;
use App\Models\Roles\Registrar;
use App\Models\Roles\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        "role_id",
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // relationship with the Role model
    public function role()
    {
        return $this->belongsTo(Role::class); // Adjust if your role relationship is different
    }

    public function student()
    {
        return $this->hasOne(Student::class, 'student_number', 'id');
    }

    public function department()
    {
        return $this->hasOne(Department::class, 'department_id', 'id');
    }

    public function registrar()
    {
        return $this->hasOne(Registrar::class, 'registrar_id', 'id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'admin_id', 'id');
    }
}
