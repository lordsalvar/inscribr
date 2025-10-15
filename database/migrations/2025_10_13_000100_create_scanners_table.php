<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scanners', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->smallInteger('uid')->unique();
            $table->string('name')->unique();
            $table->json('print')->nullable();
            $table->string('host')->unique();
            $table->integer('port');
            $table->string('pass')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamp('synced_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scanners');
    }
};


