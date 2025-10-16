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
        Schema::create('about_pages', function (Blueprint $table) {
            $table->id();
            
            // Hero Section
            $table->string('hero_title')->nullable();
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_image')->nullable();
            
            // Company Story
            $table->string('story_title')->nullable();
            $table->text('story_content_1')->nullable();
            $table->text('story_content_2')->nullable();
            $table->text('story_content_3')->nullable();
            $table->string('story_image')->nullable();
            
            // Mission, Vision, Core Values
            $table->text('mission_title')->nullable();
            $table->text('mission_content')->nullable();
            $table->text('vision_title')->nullable();
            $table->text('vision_content')->nullable();
            $table->text('values_title')->nullable();
            $table->text('values_content')->nullable();
            
            // Our Values Section
            $table->string('our_values_title')->nullable();
            $table->text('our_values_subtitle')->nullable();
            
            // Value Items
            $table->string('value_1_title')->nullable();
            $table->text('value_1_content')->nullable();
            $table->string('value_1_icon')->nullable();
            
            $table->string('value_2_title')->nullable();
            $table->text('value_2_content')->nullable();
            $table->string('value_2_icon')->nullable();
            
            $table->string('value_3_title')->nullable();
            $table->text('value_3_content')->nullable();
            $table->string('value_3_icon')->nullable();
            
            $table->string('value_4_title')->nullable();
            $table->text('value_4_content')->nullable();
            $table->string('value_4_icon')->nullable();
            
            // Our Team Section
            $table->string('team_title')->nullable();
            $table->text('team_subtitle')->nullable();
            
            // Team Members
            $table->string('member_1_name')->nullable();
            $table->string('member_1_position')->nullable();
            $table->text('member_1_description')->nullable();
            $table->string('member_1_image')->nullable();
            
            $table->string('member_2_name')->nullable();
            $table->string('member_2_position')->nullable();
            $table->text('member_2_description')->nullable();
            $table->string('member_2_image')->nullable();
            
            $table->string('member_3_name')->nullable();
            $table->string('member_3_position')->nullable();
            $table->text('member_3_description')->nullable();
            $table->string('member_3_image')->nullable();
            
            // Statistics Section
            $table->string('stats_title')->nullable();
            $table->text('stats_subtitle')->nullable();
            
            $table->string('stat_1_number')->nullable();
            $table->string('stat_1_label')->nullable();
            $table->string('stat_1_icon')->nullable();
            
            $table->string('stat_2_number')->nullable();
            $table->string('stat_2_label')->nullable();
            $table->string('stat_2_icon')->nullable();
            
            $table->string('stat_3_number')->nullable();
            $table->string('stat_3_label')->nullable();
            $table->string('stat_3_icon')->nullable();
            
            $table->string('stat_4_number')->nullable();
            $table->string('stat_4_label')->nullable();
            $table->string('stat_4_icon')->nullable();
            
            // CTA Section
            $table->string('cta_title')->nullable();
            $table->text('cta_subtitle')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_pages');
    }
};
