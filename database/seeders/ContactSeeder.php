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
                'name' => 'Nguyễn Thị Lan',
                'email' => 'lan.nguyen@email.com',
                'phone' => '+84707259881',
                'message' => 'cần tìm bàn ghế văn phòng cho 20 nhâ viên',
                'status' => 'new',
            ],
            [
                'name' => 'Trần Văn Nam',
                'email' => 'nam.tran@email.com',
                'phone' => '+84707259881',
                'message' => 'tôi muốn tư vấn về sản phẩm bàn họp',
                'status' => 'new',
            ],
            [
                'name' => 'Lê Thị Hồng',
                'email' => 'hong.le@email.com',
                'phone' => '+84707259881',
                'message' => 'cần báo giá cho đơn hàng 50 ghế xoay',
                'status' => 'new',
            ],
            [
                'name' => 'Phạm Văn Long',
                'email' => 'long.pham@email.com',
                'phone' => '+84707259881',
                'message' => 'tôi muốn biết thêm về chính sách bảo hành',
                'status' => 'new',
            ],
            [
                'name' => 'Đỗ Thị Mai',
                'email' => 'mai.doan@email.com',
                'phone' => '+84707259881',
                'message' => 'cần tư vấn về thiết kế nội thất văn phòng',
                'status' => 'new',
            ],
        ];

        foreach ($contacts as $contact) {
            Contact::create($contact);
        }
    }
}
