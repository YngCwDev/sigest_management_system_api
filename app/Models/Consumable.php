<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Consumable extends Model
{
    /** @use HasFactory<\Database\Factories\ConsumableFactory> */
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'name',
        'description',
        'stock',
        'unit',
        'expires_at',
        'entry_date',
        'last_date'
    ];

    protected $casts = [
        'supplier_id' => 'integer',
        'description' => 'array',
        'expires_at' => 'datetime',
        'entry_date' => 'datetime',
        'last_date' => 'datetime'
    ];

    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function Supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }



}
