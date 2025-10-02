<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Employee extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'suffix',
        'sex',
        'civil_status',
        'office_id',
        'designation',
        'employment_status',
        'group',
        'registration_date',
        'scanner_id',
        'office_scanner_id',
    ];

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function enrolledOffices(): BelongsToMany
    {
        return $this->belongsToMany(Office::class)
            ->withPivot(['office_scanner_id'])
            ->withTimestamps();
    }
}
