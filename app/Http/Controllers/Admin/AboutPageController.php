<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AboutPage;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    /**
     * Display the about page settings.
     */
    public function index()
    {
        $aboutPage = AboutPage::getFirst();
        
        return view('admin.about.index', compact('aboutPage'));
    }

    /**
     * Update the about page settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            // Hero Section
            'hero_title' => 'nullable|string|max:255',
            'hero_subtitle' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // Company Story
            'story_title' => 'nullable|string|max:255',
            'story_content_1' => 'nullable|string',
            'story_content_2' => 'nullable|string',
            'story_content_3' => 'nullable|string',
            'story_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // Mission, Vision, Values
            'mission_title' => 'nullable|string|max:255',
            'mission_content' => 'nullable|string',
            'mission_icon' => 'nullable|string|max:100',
            'vision_title' => 'nullable|string|max:255',
            'vision_content' => 'nullable|string',
            'vision_icon' => 'nullable|string|max:100',
            'values_title' => 'nullable|string|max:255',
            'values_content' => 'nullable|string',
            'values_icon' => 'nullable|string|max:100',
            
            // Our Values
            'our_values_title' => 'nullable|string|max:255',
            'our_values_subtitle' => 'nullable|string',
            'value_1_title' => 'nullable|string|max:255',
            'value_1_content' => 'nullable|string',
            'value_2_title' => 'nullable|string|max:255',
            'value_2_content' => 'nullable|string',
            'value_3_title' => 'nullable|string|max:255',
            'value_3_content' => 'nullable|string',
            'value_4_title' => 'nullable|string|max:255',
            'value_4_content' => 'nullable|string',
            
            // Team
            'team_title' => 'nullable|string|max:255',
            'team_subtitle' => 'nullable|string',
            'member_1_name' => 'nullable|string|max:255',
            'member_1_position' => 'nullable|string|max:255',
            'member_1_description' => 'nullable|string',
            'member_1_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'member_2_name' => 'nullable|string|max:255',
            'member_2_position' => 'nullable|string|max:255',
            'member_2_description' => 'nullable|string',
            'member_2_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'member_3_name' => 'nullable|string|max:255',
            'member_3_position' => 'nullable|string|max:255',
            'member_3_description' => 'nullable|string',
            'member_3_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            
            // Statistics
            'stats_title' => 'nullable|string|max:255',
            'stats_subtitle' => 'nullable|string',
            'stat_1_number' => 'nullable|string|max:50',
            'stat_1_label' => 'nullable|string|max:255',
            'stat_1_icon' => 'nullable|string|max:100',
            'stat_2_number' => 'nullable|string|max:50',
            'stat_2_label' => 'nullable|string|max:255',
            'stat_2_icon' => 'nullable|string|max:100',
            'stat_3_number' => 'nullable|string|max:50',
            'stat_3_label' => 'nullable|string|max:255',
            'stat_3_icon' => 'nullable|string|max:100',
            'stat_4_number' => 'nullable|string|max:50',
            'stat_4_label' => 'nullable|string|max:255',
            'stat_4_icon' => 'nullable|string|max:100',
            
            // CTA
            'cta_title' => 'nullable|string|max:255',
            'cta_subtitle' => 'nullable|string',
        ]);

        $aboutPage = AboutPage::getFirst();
        
        // Prepare data for update
        $data = $request->only([
            'hero_title', 'hero_subtitle',
            'story_title', 'story_content_1', 'story_content_2', 'story_content_3',
            'mission_title', 'mission_content', 'mission_icon', 'vision_title', 'vision_content', 'vision_icon', 'values_title', 'values_content', 'values_icon',
            'our_values_title', 'our_values_subtitle',
            'value_1_title', 'value_1_content', 'value_2_title', 'value_2_content',
            'value_3_title', 'value_3_content', 'value_4_title', 'value_4_content',
            'team_title', 'team_subtitle',
            'member_1_name', 'member_1_position', 'member_1_description',
            'member_2_name', 'member_2_position', 'member_2_description',
            'member_3_name', 'member_3_position', 'member_3_description',
            'stats_title', 'stats_subtitle',
            'stat_1_number', 'stat_1_label', 'stat_1_icon', 'stat_2_number', 'stat_2_label', 'stat_2_icon',
            'stat_3_number', 'stat_3_label', 'stat_3_icon', 'stat_4_number', 'stat_4_label', 'stat_4_icon',
            'cta_title', 'cta_subtitle'
        ]);

        // Handle image uploads
        $imageFields = [
            'hero_image', 'story_image', 'member_1_image', 'member_2_image', 'member_3_image'
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                // Delete old image if exists
                if ($aboutPage->$field && Storage::disk('public')->exists($aboutPage->$field)) {
                    Storage::disk('public')->delete($aboutPage->$field);
                }

                // Upload new image
                $imagePath = $request->file($field)->store('about', 'public');
                $data[$field] = $imagePath;
            }
        }

        // Update or create about page
        if ($aboutPage->exists) {
            $aboutPage->update($data);
        } else {
            AboutPage::create($data);
        }

        return redirect()->route('admin.about.index')
            ->with('success', 'Cập nhật trang giới thiệu thành công!');
    }
}