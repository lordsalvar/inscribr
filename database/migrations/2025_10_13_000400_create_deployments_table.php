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
        Schema::create('deployment', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->boolean('current')->default(false);
            $table->boolean('active')->default(true);
            $table->foreignUlid('office_id')->constrained('offices')->cascadeOnDelete();
            $table->foreignUlid('employee_id')->constrained('employees')->cascadeOnDelete();
            $table->foreignUlid('supervisor_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('deployment');
    }
};


