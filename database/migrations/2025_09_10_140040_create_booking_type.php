<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("CREATE TYPE booking_type AS ENUM ('SINGLE', 'WEEK', 'PERMANENT')");
    }

    public function down(): void
    {
        DB::statement('DROP TYPE IF EXISTS booking_type');
    }
};