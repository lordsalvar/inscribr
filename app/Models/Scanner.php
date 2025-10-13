<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Scanner extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'uid',
        'name',
        'print',
        'host',
        'port',
        'pass',
        'active',
        'synced_at',
    ];

    protected $casts = [
        'print' => 'array',
        'active' => 'boolean',
        'synced_at' => 'datetime',
    ];

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class, 'enrollment')
            ->withPivot(['uid', 'device', 'active'])
            ->withTimestamps();
    }

    public function users(): BelongsToMany
    {
        return $this->morphToMany(User::class, 'assignable', 'assignments')
            ->withPivot(['active'])
            ->withTimestamps();
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(Enrollment::class);
    }
}


