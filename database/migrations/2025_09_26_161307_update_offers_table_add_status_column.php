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
        Schema::table('offers', function (Blueprint $table) {
            $table->enum('status', ['active', 'inactive'])->default('active')->after('active');
        });
        
        // Copy data from active column to status column
        DB::statement("UPDATE offers SET status = CASE WHEN active = 1 THEN 'active' ELSE 'inactive' END");
        
        // Drop the old active column
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->boolean('active')->default(true)->after('status');
        });
        
        // Copy data from status column to active column
        DB::statement("UPDATE offers SET active = CASE WHEN status = 'active' THEN 1 ELSE 0 END");
        
        // Drop the status column
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
