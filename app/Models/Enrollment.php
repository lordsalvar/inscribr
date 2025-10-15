<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enrollment extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'enrollment';

    protected $fillable = [
        'uid',
        'employee_id',
        'scanner_id',
        'device',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function scanner(): BelongsTo
    {
        return $this->belongsTo(Scanner::class);
    }
}


