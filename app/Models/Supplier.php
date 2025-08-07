<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{

    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;


    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'country',
        'agent',
        'agent_phone',
        'is_active',
        'contract_expires'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'contract_expires' => 'date'
    ];

    public function supplies(): HasMany
    {
        return $this->hasMany(Supply::class);
    }
}
