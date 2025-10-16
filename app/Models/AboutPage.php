<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use HasFactory;

    protected $fillable = [
        // Hero Section
        'hero_title', 'hero_subtitle', 'hero_image',
        
        // Company Story
        'story_title', 'story_content_1', 'story_content_2', 'story_content_3', 'story_image',
        
        // Mission, Vision, Core Values
        'mission_title', 'mission_content', 'mission_icon', 'vision_title', 'vision_content', 'vision_icon', 'values_title', 'values_content', 'values_icon',
        
        // Our Values Section
        'our_values_title', 'our_values_subtitle',
        
        // Value Items
        'value_1_title', 'value_1_content', 'value_1_icon',
        'value_2_title', 'value_2_content', 'value_2_icon',
        'value_3_title', 'value_3_content', 'value_3_icon',
        'value_4_title', 'value_4_content', 'value_4_icon',
        
        // Our Team Section
        'team_title', 'team_subtitle',
        
        // Team Members
        'member_1_name', 'member_1_position', 'member_1_description', 'member_1_image',
        'member_2_name', 'member_2_position', 'member_2_description', 'member_2_image',
        'member_3_name', 'member_3_position', 'member_3_description', 'member_3_image',
        
        // Statistics Section
        'stats_title', 'stats_subtitle',
        'stat_1_number', 'stat_1_label', 'stat_1_icon',
        'stat_2_number', 'stat_2_label', 'stat_2_icon',
        'stat_3_number', 'stat_3_label', 'stat_3_icon',
        'stat_4_number', 'stat_4_label', 'stat_4_icon',
        
        // CTA Section
        'cta_title', 'cta_subtitle',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the first about page record
     */
    public static function getFirst()
    {
        return static::first() ?? new static();
    }
}
