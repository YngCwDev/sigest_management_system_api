<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\Priority;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use HasFactory;

    protected $fillable = [
        'description',
        'priority',
        'status',
    ];

    protected $casts = [
        'description' => 'array',
        'priority' => Priority::class,
        'status' => OrderStatus::class,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function consumables(): HasMany
    {
        return $this->hasMany(Consumable::class);
    }
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}
