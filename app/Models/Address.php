<?php

namespace App\Models;

use App\Models\Roles\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'house_number',
        'street',
        'barangay',
        'city',
        'province',
        'zip_code',
    ];

    public function students()
    {
        return $this->hasOne(Student::class, 'address_id');
    }

    public function getFullAddress()
    {
        return implode(', ', [
            $this->house_number,
            $this->street,
            $this->barangay,
            $this->city,
            $this->province,
            $this->zip_code
        ]);
    }
}
