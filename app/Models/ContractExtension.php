<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractExtension extends Model
{
    protected $fillable = [
        'contract_id',
        'new_end_date',
        'reason',
    ];

    protected $casts = [
        'new_end_date' => 'date',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
