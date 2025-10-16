<?php

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
        Schema::table('products', function (Blueprint $table) {
            // Thay đổi precision để hỗ trợ 9 chữ số phần nguyên
            // decimal(11, 2) = 9 chữ số phần nguyên + 2 chữ số thập phân
            $table->decimal('price', 11, 2)->change();
            $table->decimal('sale_price', 11, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Revert về decimal(10, 2)
            $table->decimal('price', 10, 2)->change();
            $table->decimal('sale_price', 10, 2)->nullable()->change();
        });
    }
};