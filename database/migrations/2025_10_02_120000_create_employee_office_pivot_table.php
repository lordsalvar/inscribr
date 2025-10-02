<?php

use App\Models\Employee;
use App\Models\Office;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('employee_office', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignIdFor(Office::class)->constrained()->cascadeOnDelete();
            $table->unsignedInteger('office_scanner_id')->nullable();
            $table->timestamps();

            $table->unique(['employee_id', 'office_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_office');
    }
};


