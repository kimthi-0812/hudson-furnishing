# 🗄️ Hudson Furnishing Database

## 📋 Thông Tin Database

- **Tên file:** `hudson_furnishing_db.sql`
- **Kích thước:** 93.10 KB
- **Ngày tạo:** 16/10/2025 01:11:04
- **Database gốc:** test_hudson

## 🎯 Tính Năng Database

### ✅ Đã Cải Tiến So Với Backup Cũ:

#### 🏗️ Cấu Trúc Mới:
- ✅ **Cột `username`** trong bảng `users`
- ✅ **Cột `primary_image`** trong bảng `products`
- ✅ **Cột `discount_type`** trong bảng `products`
- ✅ **Cột `discount_value`** trong bảng `products`
- ✅ **Cột `specifications`** trong bảng `products`
- ✅ **Bảng `audit_logs`** để tracking thay đổi
- ✅ **Bảng `visitors`** để tracking khách truy cập
- ✅ **Bảng `about_pages`** để quản lý nội dung trang giới thiệu

#### 📊 Dữ Liệu Đầy Đủ:
- ✅ **8 Users** (bao gồm 1 admin, 1 staff, 6 customers)
- ✅ **42 Products** (đầy đủ sản phẩm từ backup + mới)
- ✅ **26 Categories** (đầy đủ danh mục)
- ✅ **10 Sections** (đầy đủ khu vực)
- ✅ **6 Brands** (đầy đủ thương hiệu)
- ✅ **11 Materials** (đầy đủ chất liệu)
- ✅ **7 Offers** (đầy đủ khuyến mãi)
- ✅ **29 Reviews** (đầy đủ đánh giá)
- ✅ **6 Contacts** (đầy đủ liên hệ)
- ✅ **7 Gallery** (đầy đủ hình ảnh)
- ✅ **47 Site Settings** (đầy đủ cài đặt)

## 🔑 Thông Tin Đăng Nhập

### 👨‍💼 Admin:
- **Email:** `admin@hudsonfurnishing.com`
- **Password:** `Admin123!`
- **Role:** admin

### 👨‍💻 Staff:
- **Email:** `user2@gmail.com`
- **Password:** `Password123!`
- **Role:** staff

### 👨‍💼 Admin 2:
- **Email:** `admin2@hudsonfurnishing.com`
- **Password:** `Admin123!`
- **Role:** admin

## 🚀 Cách Import Database

### 1. Tạo Database Mới:
```sql
CREATE DATABASE hudson_furnishing_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 2. Import Database:
```bash
mysql -u root -p hudson_furnishing_db < hudson_furnishing_db.sql
```

### 3. Hoặc sử dụng phpMyAdmin:
1. Tạo database mới
2. Chọn tab "Import"
3. Chọn file `hudson_furnishing_db.sql`
4. Click "Go"

## 🔧 Cấu Hình Laravel

### File `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=hudson_furnishing_db
DB_USERNAME=root
DB_PASSWORD=your_password
```

## 📋 Danh Sách Bảng

| Bảng | Mô Tả | Số Records |
|------|-------|------------|
| `users` | Người dùng hệ thống | 8 |
| `roles` | Vai trò người dùng | 3 |
| `products` | Sản phẩm | 42 |
| `categories` | Danh mục sản phẩm | 26 |
| `sections` | Khu vực sản phẩm | 10 |
| `brands` | Thương hiệu | 6 |
| `materials` | Chất liệu | 11 |
| `offers` | Khuyến mãi | 7 |
| `reviews` | Đánh giá sản phẩm | 29 |
| `contacts` | Liên hệ | 6 |
| `gallery` | Thư viện hình ảnh | 7 |
| `site_settings` | Cài đặt website | 47 |
| `audit_logs` | Log thay đổi | 0 |
| `visitors` | Tracking khách truy cập | 0 |
| `about_pages` | Nội dung trang giới thiệu | 0 |

## 🎨 Tính Năng Mới

### 🖼️ Quản Lý Hình Ảnh:
- Hình ảnh chính cho sản phẩm
- Thư viện hình ảnh gallery
- Upload và quản lý hình ảnh

### 💰 Hệ Thống Giảm Giá:
- Giảm giá theo phần trăm
- Giảm giá cố định
- Tính toán giá khuyến mãi tự động

### 📝 Quản Lý Nội Dung:
- Trang giới thiệu có thể chỉnh sửa
- Quản lý cài đặt website
- Hệ thống liên hệ

### 🔍 Audit Logs:
- Theo dõi mọi thay đổi dữ liệu
- Log IP và user agent
- Lưu trữ old/new values

## 🚨 Lưu Ý Quan Trọng

1. **Backup:** Luôn backup database trước khi import
2. **Permissions:** Đảm bảo user MySQL có quyền tạo database
3. **Charset:** Sử dụng utf8mb4 để hỗ trợ emoji
4. **Foreign Keys:** Tất cả foreign key constraints đã được bao gồm

## 📞 Hỗ Trợ

Nếu gặp vấn đề khi import database, hãy kiểm tra:
- Quyền MySQL user
- Kích thước file upload (nếu dùng phpMyAdmin)
- Charset của database
- Version MySQL/MariaDB

---
**🎉 Database Hudson Furnishing đã sẵn sàng để sử dụng!**
