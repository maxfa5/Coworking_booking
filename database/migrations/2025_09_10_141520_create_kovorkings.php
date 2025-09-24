<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kovorkings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('type_id')->nullable()->constrained('objects_types')->onDelete('set null');
            $table->time('from_at')->nullable();
            $table->time('to_at')->nullable();
            $table->integer('floor_number')->nullable();
            $table->string('metadata')->nullable();
            $table->boolean('is_hidden')->default(false);
            $table->integer('capacity')->default(1);
            $table->foreignId('building_id')->constrained('buildings')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kovorkings');
    }
};