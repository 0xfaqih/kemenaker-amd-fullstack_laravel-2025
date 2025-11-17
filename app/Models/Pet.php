<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pet extends Model
{
    protected $fillable = [
        'owner_id',
        'code',
        'name',
        'type',
        'age',
        'weight',
    ];

    protected $casts = [
        'age' => 'integer',
        'weight' => 'decimal:2',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    public function checkups(): HasMany
    {
        return $this->hasMany(Checkup::class);
    }
}
