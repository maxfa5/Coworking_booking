<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kovorking_id')->constrained('kovorkings')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestampTz('start_time')->nullable();
            $table->timestampTz('end_time')->nullable();
            $table->timestampTz('period_start_at')->nullable();
            $table->integer('day_of_week')->nullable()->comment('0-6 (Sunday-Saturday)');
            $table->timestampTz('period_end_at')->nullable();
            $table->enum('type', ['SINGLE', 'WEEK', 'PERMANENT'])->default('SINGLE');
            $table->timestampsTz();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};