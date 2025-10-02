<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contacts = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@email.com',
                'phone' => '+1-555-0123',
                'message' => 'I\'m interested in your bedroom furniture collection. Could you please send me more information about the complete bedroom sets?',
                'status' => 'new',
            ],
            [
                'name' => 'Sarah Wilson',
                'email' => 'sarah.wilson@email.com',
                'phone' => '+1-555-0124',
                'message' => 'Do you offer delivery services to the downtown area? I\'m looking to purchase a dining room set.',
                'status' => 'read',
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'mike.johnson@email.com',
                'phone' => '+1-555-0125',
                'message' => 'I\'d like to schedule a consultation for furnishing my new home office. What are your available appointment times?',
                'status' => 'new',
            ],
            [
                'name' => 'Emily Brown',
                'email' => 'emily.brown@email.com',
                'phone' => '+1-555-0126',
                'message' => 'Are there any current promotions on outdoor furniture? I\'m planning to furnish my patio.',
                'status' => 'read',
            ],
            [
                'name' => 'David Miller',
                'email' => 'david.miller@email.com',
                'phone' => '+1-555-0127',
                'message' => 'I\'m interested in custom furniture options. Do you offer customization services?',
                'status' => 'new',
            ],
            [
                'name' => 'Lisa Davis',
                'email' => 'lisa.davis@email.com',
                'phone' => '+1-555-0128',
                'message' => 'Could you provide information about your warranty policy for furniture purchases?',
                'status' => 'read',
            ],
            [
                'name' => 'Robert Garcia',
                'email' => 'robert.garcia@email.com',
                'phone' => '+1-555-0129',
                'message' => 'I\'m looking for eco-friendly furniture options. What sustainable materials do you offer?',
                'status' => 'new',
            ],
            [
                'name' => 'Jennifer Martinez',
                'email' => 'jennifer.martinez@email.com',
                'phone' => '+1-555-0130',
                'message' => 'Do you have a showroom where I can view the furniture in person before purchasing?',
                'status' => 'read',
            ],
            [
                'name' => 'Michael Taylor',
                'email' => 'michael.taylor@email.com',
                'phone' => '+1-555-0131',
                'message' => 'I\'m interested in bulk pricing for furnishing multiple rooms. What discounts are available?',
                'status' => 'new',
            ],
            [
                'name' => 'Amanda Anderson',
                'email' => 'amanda.anderson@email.com',
                'phone' => '+1-555-0132',
                'message' => 'Could you recommend furniture pieces that would work well in a small apartment?',
                'status' => 'read',
            ],
            [
                'name' => 'Christopher White',
                'email' => 'christopher.white@email.com',
                'phone' => '+1-555-0133',
                'message' => 'I\'m looking for vintage-style furniture. Do you carry any retro or antique pieces?',
                'status' => 'new',
            ],
            [
                'name' => 'Rachel Thompson',
                'email' => 'rachel.thompson@email.com',
                'phone' => '+1-555-0134',
                'message' => 'What is your return policy? I want to make sure I can return items if they don\'t fit my space.',
                'status' => 'read',
            ],
            [
                'name' => 'Thomas Clark',
                'email' => 'thomas.clark@email.com',
                'phone' => '+1-555-0135',
                'message' => 'Do you offer assembly services for furniture delivery? I\'d prefer professional installation.',
                'status' => 'new',
            ],
            [
                'name' => 'Maria Rodriguez',
                'email' => 'maria.rodriguez@email.com',
                'phone' => '+1-555-0136',
                'message' => 'I\'m interested in your designer collection. Could you send me a catalog or brochure?',
                'status' => 'read',
            ],
            [
                'name' => 'James Lee',
                'email' => 'james.lee@email.com',
                'phone' => '+1-555-0137',
                'message' => 'What financing options do you offer for large furniture purchases?',
                'status' => 'new',
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
