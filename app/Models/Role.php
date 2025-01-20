<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Define the inverse relationship with the User model
    public function users()
    {
        return $this->hasMany(User::class); // One role can have many users
    }

    public $timestamps = false;

}
