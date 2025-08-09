<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Supply extends Model
{
    /** @use HasFactory<\Database\Factories\SupplyFactory> */
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
        'expires_at' => 'date',
        'entry_date' => 'datetime',
        'last_date' => 'datetime'
    ];

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItems::class);
    }

    public function Supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }



}
