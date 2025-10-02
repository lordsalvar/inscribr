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
            $table->foreignUlid('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignUlid('office_id')->constrained('offices')->cascadeOnDelete();
            $table->unsignedInteger('office_scanner_id')->nullable();
            $table->timestamps();

            $table->primary(['employee_id', 'office_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('employee_office');
    }
};


