<?php

namespace App\Models\Roles;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $primaryKey = 'admin_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'admin_id',
        'last_name',
        'first_name',
        'middle_name',
        'extension_name',
        'contact_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'admin_id', 'id');
    }
}
