# 🏠 Hudson Furnishing

> **Nội thất cao cấp cho mọi không gian** - Modern furniture e-commerce platform built with Laravel

## 🌟 Features

- **Product Catalog**: Browse furniture by categories, brands, materials
- **Admin Dashboard**: Complete management system
- **Responsive Design**: Mobile-first approach
- **User Authentication**: Role-based access control
- **Settings Management**: Tabbed interface with live previews

## 🚀 Tech Stack

- Laravel 10.x (PHP 8.1+)
- Bootstrap 5.3
- MySQL
- Vite + NPM

## 🛠️ Installation

```bash
# Clone repository
git clone https://github.com/kimthi-0812/hudson-furnishing.git
cd hudson-furnishing

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure database in .env file
# Then run:
php artisan migrate:fresh --seed
php artisan storage:link
npm run build
php artisan serve
```

## 👥 Default Login

**Admin**: `admin@hudsonfurnishing.com` / `admin123`
**User**: `buu.le@gmail.com` / `password123`

## 📞 Contact

- **Email**: info@hudsonfurnishing.vn
- **Phone**: +84 (0) 123 45 67 89

---
Made with ❤️ for furniture lovers