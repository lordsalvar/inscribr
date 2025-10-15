<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Office extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'acronym',
        'name',
        'code',
        'employee_id',
        'description',
    ];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    /**
     * Get the officers (users) assigned to this office.
     */
    public function officers(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function enrolledEmployees(): BelongsToMany
    {
        return $this->belongsToMany(Employee::class)
            ->withPivot(['office_scanner_id'])
            ->withTimestamps();
    }

    public function deployments(): HasMany
    {
        return $this->hasMany(Deployment::class);
    }

    public function head(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
