<?php

use App\Models\Office;
use App\Enums\Status;
use App\Enums\OfficeStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('uid')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('sex');
            $table->string('civil_status');
            $table->foreignIdFor(Office::class)->constrained;
            $table->string('designation')->nullable();
            $table->string('employment_status');
            $table->string('group')->nullable();
            $table->timestamp('registration_date');
            $table->integer('scanner_id');
            $table->string('status')->default(Status::ACTIVE);
            $table->boolean('active')->default(true);
            $table->integer('office_scanner_id')->nullable();
            $table->string('office_status')->default(OfficeStatus::ACTIVE);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
