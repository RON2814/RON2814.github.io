<?php

namespace App\Models\Roles;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registrar extends Model
{
    use HasFactory;

    protected $primaryKey = 'registrar_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'registrar_id',
        'last_name',
        'first_name',
        'middle_name',
        'extension_name',
        'contact_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'registrar_id', 'id');
    }
}
