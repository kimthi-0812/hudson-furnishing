# 🧪 HƯỚNG DẪN KIỂM TRA TÍNH NĂNG MỚI

## 📋 **CHECKLIST KIỂM TRA**

### **1. 📊 THỐNG KÊ USER ĐĂNG KÝ**
- [ ] Truy cập: `http://localhost:8001/admin`
- [ ] Kiểm tra card "Tổng Người Dùng" hiển thị số liệu
- [ ] Click vào card → Xem danh sách users
- [ ] Verify số liệu chính xác

### **2. 🖼️ THƯ VIỆN ĐỘC LẬP**

#### **Admin Panel:**
- [ ] Truy cập: `http://localhost:8001/admin/independent-gallery`
- [ ] Kiểm tra menu "Thư Viện Độc Lập" trong sidebar
- [ ] Test tạo gallery mới:
  - [ ] Upload hình ảnh
  - [ ] Nhập title, description
  - [ ] Set status active/inactive
  - [ ] Save thành công
- [ ] Test edit gallery:
  - [ ] Sửa thông tin
  - [ ] Thay đổi hình ảnh
  - [ ] Set primary image
- [ ] Test delete gallery
- [ ] Test filter và search

#### **Frontend:**
- [ ] Truy cập: `http://localhost:8001/independent-gallery`
- [ ] Kiểm tra gallery hiển thị đẹp mắt
- [ ] Test search functionality
- [ ] Click vào 1 hình → Xem detail page
- [ ] Kiểm tra related images
- [ ] Test responsive design

### **3. 🎠 CAROUSEL/SLIDER CRUD**

#### **Admin Panel:**
- [ ] Truy cập: `http://localhost:8001/admin/carousels`
- [ ] Kiểm tra menu "Carousel/Slider" trong sidebar
- [ ] Test tạo slide mới:
  - [ ] Upload hình ảnh
  - [ ] Nhập title (có thể thay đổi)
  - [ ] Nhập description
  - [ ] Nhập button text & URL
  - [ ] Set sort order
  - [ ] Set active/inactive
  - [ ] Save thành công
- [ ] Test edit slide
- [ ] Test toggle status
- [ ] Test delete slide

#### **Frontend:**
- [ ] Truy cập: `http://localhost:8001`
- [ ] Kiểm tra homepage carousel hiển thị slides từ database
- [ ] Verify dynamic titles và descriptions
- [ ] Test button functionality
- [ ] Kiểm tra auto-rotation
- [ ] Test responsive design

### **4. 📞 LIÊN HỆ TỪ SẢN PHẨM**

#### **Product Detail Page:**
- [ ] Truy cập: `http://localhost:8001/products`
- [ ] Chọn 1 sản phẩm bất kỳ
- [ ] Kiểm tra button "Liên Hệ Tư Vấn"
- [ ] Click button → Redirect đến contact page

#### **Contact Page:**
- [ ] Verify URL có `product_id` parameter
- [ ] Kiểm tra title: "Liên Hệ Về [Tên Sản Phẩm]"
- [ ] Verify product info card hiển thị:
  - [ ] Hình ảnh sản phẩm
  - [ ] Tên, danh mục, thương hiệu
  - [ ] Giá sản phẩm
  - [ ] Mô tả
- [ ] Kiểm tra form auto-fill:
  - [ ] Hidden field `product_id`
  - [ ] Placeholder message: "Tôi đang quan tâm đến sản phẩm..."
  - [ ] Button text: "Gửi Yêu Cầu Tư Vấn"
- [ ] Test submit form thành công

#### **Admin Contact Management:**
- [ ] Truy cập: `http://localhost:8001/admin/contacts`
- [ ] Kiểm tra cột "Sản Phẩm" hiển thị:
  - [ ] Tên sản phẩm (nếu có)
  - [ ] "Chung" (nếu không có)
- [ ] Click vào tên sản phẩm → Redirect đến product detail

### **5. 🔍 ENHANCED GALLERY SYSTEM**
- [ ] Truy cập: `http://localhost:8001`
- [ ] Click menu "Thư Viện" → Verify dropdown:
  - [ ] "Thư Viện Sản Phẩm"
  - [ ] "Thư Viện Độc Lập"
- [ ] Test cả 2 links hoạt động

## 🚀 **TÍNH NĂNG BỔ SUNG ĐÃ CẢI TIẾN**

### **Slug Duplicate Handling:**
- [ ] Test tạo sản phẩm với tên trùng
- [ ] Verify slug tự động thêm suffix (-1, -2, etc.)

### **Review System:**
- [ ] Test submit review
- [ ] Admin approval workflow
- [ ] Hiển thị approved reviews

### **Category-Section Management:**
- [ ] Kiểm tra cascade dropdown hoạt động
- [ ] Filter categories theo section

## 🐛 **KIỂM TRA LỖI**

### **Database:**
- [ ] Kiểm tra migrations đã chạy
- [ ] Verify foreign key relationships
- [ ] Test soft deletes

### **File Uploads:**
- [ ] Test upload images
- [ ] Verify file storage
- [ ] Test image deletion

### **Responsive Design:**
- [ ] Test trên mobile
- [ ] Test trên tablet
- [ ] Test trên desktop

## 📝 **GHI CHÚ KIỂM TRA**

### **Admin Login:**
- Email: `admin@hudsonfurnishing.com`
- Password: `Admin123!`

### **Test Data:**
- Sử dụng seeder data có sẵn
- Hoặc tạo data test mới

### **Browser Testing:**
- Chrome/Edge
- Firefox
- Safari (nếu có Mac)

## ✅ **KẾT QUẢ MONG ĐỢI**

Tất cả tính năng mới phải:
1. ✅ Hoạt động ổn định
2. ✅ UI/UX đẹp mắt
3. ✅ Responsive design
4. ✅ Không có lỗi JavaScript
5. ✅ Validation hoạt động
6. ✅ Database integrity
7. ✅ Security (middleware protection)

---

**🎉 Sau khi hoàn thành checklist này, project sẽ có đầy đủ tính năng theo yêu cầu của giảng viên!**
