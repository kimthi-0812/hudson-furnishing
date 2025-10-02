<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\Product;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reviews = [
            // Reviews for Modern Platform Bed (Product ID: 1)
            [
                'product_id' => 1,
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@email.com',
                'rating' => 5,
                'comment' => 'Absolutely love this bed! The storage drawers are perfect for keeping the bedroom organized. Assembly was straightforward and the quality is excellent.',
                'approved' => true,
            ],
            [
                'product_id' => 1,
                'name' => 'Mike Chen',
                'email' => 'mike.chen@email.com',
                'rating' => 4,
                'comment' => 'Great bed with modern design. The platform is sturdy and the drawers work smoothly. Only minor issue was the delivery time.',
                'approved' => true,
            ],
            [
                'product_id' => 1,
                'name' => 'Emily Rodriguez',
                'email' => 'emily.rodriguez@email.com',
                'rating' => 5,
                'comment' => 'Perfect addition to our modern bedroom. The clean lines and functionality exceeded our expectations. Highly recommended!',
                'approved' => true,
            ],

            // Reviews for Oak Wardrobe (Product ID: 2)
            [
                'product_id' => 2,
                'name' => 'David Thompson',
                'email' => 'david.thompson@email.com',
                'rating' => 5,
                'comment' => 'Beautiful oak wardrobe with excellent craftsmanship. The sliding doors work perfectly and there\'s plenty of storage space.',
                'approved' => true,
            ],
            [
                'product_id' => 2,
                'name' => 'Lisa Wang',
                'email' => 'lisa.wang@email.com',
                'rating' => 4,
                'comment' => 'Solid construction and beautiful wood grain. Takes up more space than expected but the quality is worth it.',
                'approved' => true,
            ],

            // Reviews for Sectional Sofa (Product ID: 6)
            [
                'product_id' => 6,
                'name' => 'Robert Martinez',
                'email' => 'robert.martinez@email.com',
                'rating' => 5,
                'comment' => 'Incredibly comfortable sectional sofa. Perfect for family movie nights. The fabric is durable and easy to clean.',
                'approved' => true,
            ],
            [
                'product_id' => 6,
                'name' => 'Jennifer Lee',
                'email' => 'jennifer.lee@email.com',
                'rating' => 4,
                'comment' => 'Great sofa with excellent comfort. The L-shape configuration works perfectly in our living room. Delivery was prompt.',
                'approved' => true,
            ],
            [
                'product_id' => 6,
                'name' => 'Michael Brown',
                'email' => 'michael.brown@email.com',
                'rating' => 5,
                'comment' => 'Outstanding quality and comfort. This sectional has become the centerpiece of our living room. Worth every penny!',
                'approved' => true,
            ],

            // Reviews for Farmhouse Dining Table (Product ID: 11)
            [
                'product_id' => 11,
                'name' => 'Amanda Davis',
                'email' => 'amanda.davis@email.com',
                'rating' => 5,
                'comment' => 'Beautiful farmhouse table that seats our family of 8 comfortably. The distressed finish gives it authentic character.',
                'approved' => true,
            ],
            [
                'product_id' => 11,
                'name' => 'Christopher Wilson',
                'email' => 'christopher.wilson@email.com',
                'rating' => 4,
                'comment' => 'Solid construction and beautiful design. The table is heavy but that shows quality. Perfect for family gatherings.',
                'approved' => true,
            ],

            // Reviews for Executive Desk (Product ID: 16)
            [
                'product_id' => 16,
                'name' => 'Rachel Green',
                'email' => 'rachel.green@email.com',
                'rating' => 5,
                'comment' => 'Perfect executive desk for my home office. Plenty of storage and the cable management system keeps everything organized.',
                'approved' => true,
            ],
            [
                'product_id' => 16,
                'name' => 'Thomas Anderson',
                'email' => 'thomas.anderson@email.com',
                'rating' => 4,
                'comment' => 'Excellent desk with professional appearance. The drawers are spacious and the surface is perfect for dual monitors.',
                'approved' => true,
            ],

            // Reviews for Patio Dining Set (Product ID: 21)
            [
                'product_id' => 21,
                'name' => 'Maria Garcia',
                'email' => 'maria.garcia@email.com',
                'rating' => 5,
                'comment' => 'Weather-resistant patio set that looks great and holds up well outdoors. Perfect for entertaining guests.',
                'approved' => true,
            ],
            [
                'product_id' => 21,
                'name' => 'James Taylor',
                'email' => 'james.taylor@email.com',
                'rating' => 4,
                'comment' => 'Good quality outdoor furniture. The chairs are comfortable and the table is sturdy. Assembly was straightforward.',
                'approved' => true,
            ],

            // Reviews for Complete Bedroom Set (Product ID: 5)
            [
                'product_id' => 5,
                'name' => 'Nicole Smith',
                'email' => 'nicole.smith@email.com',
                'rating' => 5,
                'comment' => 'Complete bedroom transformation! All pieces match perfectly and the quality is outstanding. Great value for the money.',
                'approved' => true,
            ],
            [
                'product_id' => 5,
                'name' => 'Kevin Johnson',
                'email' => 'kevin.johnson@email.com',
                'rating' => 4,
                'comment' => 'Beautiful bedroom set with consistent styling. The delivery and assembly service was professional and efficient.',
                'approved' => true,
            ],

            // Reviews for Living Room Set (Product ID: 10)
            [
                'product_id' => 10,
                'name' => 'Stephanie White',
                'email' => 'stephanie.white@email.com',
                'rating' => 5,
                'comment' => 'Complete living room makeover with this set. Everything coordinates beautifully and the quality is top-notch.',
                'approved' => true,
            ],
            [
                'product_id' => 10,
                'name' => 'Daniel Clark',
                'email' => 'daniel.clark@email.com',
                'rating' => 4,
                'comment' => 'Great living room set that transformed our space. The entertainment center has plenty of storage for all our media.',
                'approved' => true,
            ],

            // Reviews for Complete Dining Set (Product ID: 14)
            [
                'product_id' => 14,
                'name' => 'Ashley Miller',
                'email' => 'ashley.miller@email.com',
                'rating' => 5,
                'comment' => 'Elegant dining set that\'s perfect for hosting dinner parties. The chairs are comfortable and the table is spacious.',
                'approved' => true,
            ],
            [
                'product_id' => 14,
                'name' => 'Ryan Davis',
                'email' => 'ryan.davis@email.com',
                'rating' => 4,
                'comment' => 'Beautiful dining room set with excellent craftsmanship. The sideboard provides additional storage and display space.',
                'approved' => true,
            ],

            // Reviews for Complete Office Set (Product ID: 20)
            [
                'product_id' => 20,
                'name' => 'Michelle Wilson',
                'email' => 'michelle.wilson@email.com',
                'rating' => 5,
                'comment' => 'Perfect home office setup! All pieces work together seamlessly and create a professional workspace.',
                'approved' => true,
            ],
            [
                'product_id' => 20,
                'name' => 'Andrew Brown',
                'email' => 'andrew.brown@email.com',
                'rating' => 4,
                'comment' => 'Excellent office furniture set with great storage solutions. The ergonomic chair is comfortable for long work sessions.',
                'approved' => true,
            ],

            // Additional reviews for variety
            [
                'product_id' => 3,
                'name' => 'Jessica Taylor',
                'email' => 'jessica.taylor@email.com',
                'rating' => 5,
                'comment' => 'Minimalist nightstand that fits perfectly with our modern bedroom design. Clean and functional.',
                'approved' => true,
            ],
            [
                'product_id' => 7,
                'name' => 'Brandon Moore',
                'email' => 'brandon.moore@email.com',
                'rating' => 4,
                'comment' => 'Glass coffee table adds elegance to our living room. Easy to clean and maintain.',
                'approved' => true,
            ],
            [
                'product_id' => 12,
                'name' => 'Samantha Garcia',
                'email' => 'samantha.garcia@email.com',
                'rating' => 5,
                'comment' => 'Comfortable dining chairs that look great and provide excellent support during long meals.',
                'approved' => true,
            ],
            [
                'product_id' => 17,
                'name' => 'Tyler Anderson',
                'email' => 'tyler.anderson@email.com',
                'rating' => 4,
                'comment' => 'Ergonomic office chair that has improved my posture and comfort during work hours.',
                'approved' => true,
            ],
            [
                'product_id' => 22,
                'name' => 'Olivia Martinez',
                'email' => 'olivia.martinez@email.com',
                'rating' => 5,
                'comment' => 'Beautiful garden bench that adds charm to our outdoor space. Weather-resistant and comfortable.',
                'approved' => true,
            ],
        ];

        foreach ($reviews as $review) {
            Review::create($review);
        }
    }
}
