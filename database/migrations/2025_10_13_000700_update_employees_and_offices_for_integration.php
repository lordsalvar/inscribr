<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            if (!Schema::hasColumn('employees', 'uid')) {
                $table->string('uid')->nullable()->after('id');
            }
            if (!Schema::hasColumn('employees', 'email')) {
                $table->string('email')->nullable()->after('last_name');
            }
            if (!Schema::hasColumn('employees', 'status')) {
                $table->string('status')->default('active')->after('scanner_id');
            }
            if (!Schema::hasColumn('employees', 'active')) {
                $table->boolean('active')->default(true)->after('status');
            }
            if (!Schema::hasColumn('employees', 'deleted_at')) {
                $table->softDeletes();
            }
        });

        Schema::table('offices', function (Blueprint $table) {
            if (!Schema::hasColumn('offices', 'code')) {
                $table->string('code')->nullable()->after('name');
            }
            if (!Schema::hasColumn('offices', 'employee_id')) {
                $table->ulid('employee_id')->nullable()->after('code');
            }
            if (!Schema::hasColumn('offices', 'description')) {
                $table->text('description')->nullable()->after('employee_id');
            }
            if (!Schema::hasColumn('offices', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            if (Schema::hasColumn('employees', 'uid')) {
                $table->dropColumn('uid');
            }
            if (Schema::hasColumn('employees', 'email')) {
                $table->dropColumn('email');
            }
            if (Schema::hasColumn('employees', 'status')) {
                $table->dropColumn('status');
            }
            if (Schema::hasColumn('employees', 'active')) {
                $table->dropColumn('active');
            }
            if (Schema::hasColumn('employees', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });

        Schema::table('offices', function (Blueprint $table) {
            if (Schema::hasColumn('offices', 'code')) {
                $table->dropColumn('code');
            }
            if (Schema::hasColumn('offices', 'employee_id')) {
                $table->dropColumn('employee_id');
            }
            if (Schema::hasColumn('offices', 'description')) {
                $table->dropColumn('description');
            }
            if (Schema::hasColumn('offices', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};


