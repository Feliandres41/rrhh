<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Collaborator extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'last_name',
        'document_number',
        'email',
        'phone',
        'status',
    ];

    // Estados permitidos
    public const STATUS_ACTIVE = 'active';
    public const STATUS_INACTIVE = 'inactive';

    protected $casts = [
        'deleted_at' => 'datetime',
    ];

    /*relaciones*/

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    /*accesor*/

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
