<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('products', 'image')) {
            return;
        }

        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            // PostgreSQL: تحويل العمود إلى JSON باستخدام USING
            DB::statement('ALTER TABLE products ALTER COLUMN image TYPE json USING image::json');
        } elseif ($driver === 'sqlite') {
            // SQLite: لا يدعم تغيير نوع العمود مباشرة، لكننا لا نحتاج إلى تغييره
            // لأن SQLite يخزن JSON كنص، وسيظل يعمل مع `$casts = ['image' => 'array']`.
            // لذا نتركه كما هو.
            // يمكننا إضافة تعليق أو تنبيه.
        }
    }

    public function down(): void
    {
        if (!Schema::hasColumn('products', 'image')) {
            return;
        }

        $driver = DB::getDriverName();

        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE products ALTER COLUMN image TYPE text USING image::text');
        }
        // SQLite: لا حاجة لعمل شيء في down
    }
};