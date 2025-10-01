<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'suffix',
        'sex',
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
}
