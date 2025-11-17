<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'phone_verified',
        'address',
    ];

    protected $casts = [
        'phone_verified' => 'boolean',
    ];

    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }
}
