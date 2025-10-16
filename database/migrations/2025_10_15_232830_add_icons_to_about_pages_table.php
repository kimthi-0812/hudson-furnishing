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
        Schema::table('about_pages', function (Blueprint $table) {
            // Mission, Vision, Values icons
            $table->string('mission_icon')->nullable()->after('mission_content');
            $table->string('vision_icon')->nullable()->after('vision_content');
            $table->string('values_icon')->nullable()->after('values_content');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('about_pages', function (Blueprint $table) {
            $table->dropColumn([
                'mission_icon', 'vision_icon', 'values_icon'
            ]);
        });
    }
};
