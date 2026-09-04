<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // تحويل العمود إلى JSON باستخدام USING للـ PostgreSQL
        DB::statement('ALTER TABLE products ALTER COLUMN image TYPE json USING image::json');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE products ALTER COLUMN image TYPE text USING image::text');
    }
};