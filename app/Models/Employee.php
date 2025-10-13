<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'uid',
        'first_name',
        'last_name',
        'middle_name',
        'suffix',
        'email',
        'sex',
        'civil_status',
        'office_id',
        'designation',
        'employment_status',
        'group',
        'registration_date',
        'scanner_id',
        'status',
        'active',
        'office_scanner_id',
    ];

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class);
    }

    public function enrolledOffices(): BelongsToMany
    {
        return $this->belongsToMany(Office::class)
            ->withPivot(['office_scanner_id'])
            ->withTimestamps();
    }

    public function scanners(): BelongsToMany
    {
        return $this->belongsToMany(Scanner::class, 'enrollment')
            ->withPivot(['uid', 'device', 'active'])
            ->withTimestamps();
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'member')
            ->withPivot(['active'])
            ->withTimestamps();
    }

    public function deployments(): HasMany
    {
        return $this->hasMany(Deployment::class);
    }

    public function currentDeployment(): HasMany
    {
        return $this->deployments()->where('current', true);
    }
}
