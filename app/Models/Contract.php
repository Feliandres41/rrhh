<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'collaborator_id',
        'contract_type',
        'start_date',
        'end_date',
        'salary',
        'status',
    ];

    /*constantes*/

    public const TYPE_FIXED = 'fixed_term';
    public const TYPE_INDEFINITE = 'indefinite';
    public const TYPE_SERVICE = 'service_contract';

    public const STATUS_VIGENTE = 'vigente';
    public const STATUS_TERMINADO = 'terminado';

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'salary' => 'decimal:2',
    ];

    /*relaciones*/

    public function collaborator()
    {
        return $this->belongsTo(Collaborator::class);
    }

    public function extensions()
    {
        return $this->hasMany(ContractExtension::class);
    }

    public function termination()
    {
        return $this->hasOne(ContractTermination::class);
    }

    /*metodos de negocio*/

    public function isVigente(): bool
    {
        return $this->status === self::STATUS_VIGENTE;
    }

    public function isTerminado(): bool
    {
        return $this->status === self::STATUS_TERMINADO;
    }
}
