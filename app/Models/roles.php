<?php

namespace App\Models;

use App\Enums\UserProfile;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class roles extends Model
{
    /** @use HasFactory<\Database\Factories\RolesFactory> */
    use HasFactory;

    protected $fillable = [
        "role"
    ];

    protected $casts = [
        'role' => UserProfile::class
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
