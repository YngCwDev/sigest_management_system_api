<?php

namespace App\Models;

use App\Enums\Priority;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    /** @use HasFactory<\Database\Factories\DepartmentFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'priority',
        'description'
    ];

    protected $casts = [
        'priority' => Priority::class,
        'description' => 'array'
    ];
    
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}
