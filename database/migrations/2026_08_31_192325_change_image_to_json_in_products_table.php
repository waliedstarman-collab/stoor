<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // أولاً: تأكد من أن العمود موجود قبل التعديل
        if (Schema::hasColumn('products', 'image')) {
            // تحويل العمود إلى JSON (SQLite يدعم JSON)
            Schema::table('products', function (Blueprint $table) {
                $table->json('image')->nullable()->change();
            });
        } else {
            // إذا لم يكن موجوداً، أنشئه
            Schema::table('products', function (Blueprint $table) {
                $table->json('image')->nullable();
            });
        }
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });
    }
};