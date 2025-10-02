# Hudson Furnishing - Database Setup

## Cấu hình Database cho phpMyAdmin

### 1. Tạo Database trong phpMyAdmin
1. Mở phpMyAdmin (thường là http://localhost/phpmyadmin)
2. Tạo database mới tên: `hudson_furnishing`
3. Chọn collation: `utf8mb4_unicode_ci`

### 2. Cấu hình .env
Cập nhật file `.env` với thông tin sau:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hudson_furnishing
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Chạy Migrations
```bash
php artisan migrate
```

### 4. Chạy Seeders (Dummy Data)
```bash
php artisan db:seed
```

## Cấu trúc Database

### Tables chính:
- `users` - Người dùng (admin/client)
- `sections` - Phòng (Bedroom, Living Room, etc.)
- `categories` - Danh mục sản phẩm
- `brands` - Thương hiệu
- `materials` - Chất liệu
- `products` - Sản phẩm
- `product_images` - Hình ảnh sản phẩm
- `offers` - Khuyến mãi
- `reviews` - Đánh giá
- `contacts` - Liên hệ
- `site_settings` - Cài đặt website
- `visitor_stats` - Thống kê khách truy cập

## Palette Màu sắc
- Primary: #335c67
- Secondary: #fff3b0
- Accent: #e09f3e
- Danger: #9e2a2b
- Dark: #540b0e



