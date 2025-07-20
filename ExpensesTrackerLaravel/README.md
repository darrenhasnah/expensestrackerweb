- Darren Hasnah (03082230014)
Register/login dengan auto hash password, Database design, csrf protection, AJAX

- Vincent Frenando Tan (03082230007)
Dashboard, Fitur CRUD, Statistics, AJAX


# 💰 Expenses Tracker Laravel

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 11">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2+">
  <img src="https://img.shields.io/badge/Tailwind_CSS-3.4-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white" alt="Tailwind CSS">
  <img src="https://img.shields.io/badge/Vite-6.3-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
</p>

<p align="center">
  <strong>🎯 Personal Finance Management System</strong><br>
  Aplikasi web untuk melacak dan mengelola pengeluaran pribadi dengan dashboard yang modern dan responsif.
</p>

Pastikan sudah terinstall:
- **PHP 8.2+** dengan extensions: `mbstring`, `xml`, `ctype`, `json`, `bcmath`, `fileinfo`
- **Composer** (Dependency Manager untuk PHP)
- **Node.js 18+** dan **npm** (untuk asset building)
- **MySQL/PostgreSQL** (Database)
Laravel Expenses Tracker UAS Web 2
- Darren Hasnah (03082230014)
Register/login dengan auto hash password, Database design, csrf protection, AJAX

- Vincent Frenando Tan (03082230007)
Dashboard, Fitur CRUD, Statistics, AJAX

Sebuah aplikasi Laravel sederhana untuk melacak pengeluaran.

Installation Steps
1. Clone Repository

Clone project ini ke komputer kamu lalu pindah ke folder project.

```bash
git clone https://github.com/darrenhasnah/expensestrackerweb.git

cd ExpensesTrackerLaravel
```

2. Install PHP Dependencies
Install semua library PHP yang dibutuhkan dengan Composer.

```bash
composer install
```

3. Install Node.js Dependencies
Install semua package frontend menggunakan npm.
```bash
npm install
```

4. Environment Setup
Salin file environment contoh lalu buat application key.

```bash
cp .env.example .env
php artisan key:generate
```

5. Database Configuration
Buka file `.env` dan atur konfigurasi database sesuai dengan pengaturan MySQL kamu.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=expenses_tracker
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

6. Database Migration
Buat tabel di database dan (opsional) tambahkan data contoh.
```bash
php artisan migrate
php artisan db:seed
```

7. Build Assets
Bangun aset frontend.
```bash
npm run dev
# atau untuk produksi
npm run build
```

8. Start Development Server
Jalankan server development Laravel.
```bash
php artisan serve
```

Aplikasi bisa diakses melalui: [http://localhost:8000](http://localhost:8000)


## 🔄 Workflow untuk Multi-Device Development

### 📱 **Saat Pindah ke Device Baru:**

#### **Step 1: Pull Latest Changes**
```bash
git pull origin main
```

#### **Step 2: Update Dependencies**
```bash
# Update PHP dependencies
composer install

# Update Node.js dependencies
npm install
```

#### **Step 3: Rebuild Assets**
```bash
# Build assets untuk production
npm run build

# ATAU untuk development
npm run dev
```

#### **Step 4: Environment Check**
```bash
# Copy .env jika belum ada
cp .env.example .env

# Generate key jika belum ada
php artisan key:generate

# Run migrations jika ada perubahan
php artisan migrate
```

#### **Step 5: Start Server**
```bash
php artisan serve
```

### 💡 **Kenapa Harus Build Ulang Assets?**

- **CSS/JS Changes**: Setiap perubahan di `resources/css/` atau `resources/js/` perlu di-compile ulang
- **Vite Manifest**: File `public/build/manifest.json` berisi mapping asset yang device-specific
- **Hash Changes**: Vite menggunakan content hashing untuk cache busting
- **Environment Differences**: Path dan konfigurasi bisa berbeda antar device

---

## 🎨 **Features Overview**

### **✨ Enhanced Dashboard**
- 📊 **5 Stats Cards**: Total pengeluaran, transaksi, rata-rata, dan data bulanan
- 📅 **Month Selector**: Filter data berdasarkan bulan/tahun dengan real-time update
- 🎭 **Modern UI**: Light theme dengan animasi smooth dan responsive design
- 📱 **Mobile Friendly**: Optimized untuk semua ukuran layar

### **💰 Expense Management**
- ➕ **Add Expenses**: Form input dengan kategori dan deskripsi
- 📋 **Expense List**: Table dengan sorting dan filtering
- 🏷️ **Categories**: Makanan, Transportasi, Belanja, Hiburan, Kesehatan, dll
- 📈 **Real-time Stats**: Perhitungan otomatis tanpa reload halaman

### **🔐 Authentication**
- 👤 **User Registration & Login**
- 🔒 **Secure Session Management**
- 🚪 **Protected Routes**

---

## 🛠️ **Development Commands**

### **Asset Building:**
```bash
# Development mode (hot reload)
npm run dev

# Production build (optimized)
npm run build

# Watch mode (auto rebuild on changes)
npm run dev -- --watch
```

### **Laravel Commands:**
```bash
# Start development server
php artisan serve

# Run migrations
php artisan migrate

# Reset database with fresh migrations
php artisan migrate:fresh

# Generate new Laravel key
php artisan key:generate

# Clear all caches
php artisan optimize:clear
```

### **Database Management:**
```bash
# Create new migration
php artisan make:migration create_table_name

# Create new model
php artisan make:model ModelName

# Create controller
php artisan make:controller ControllerName
```

---

## 📁 **Project Structure**

```
ExpensesTrackerLaravel/
├── 📂 app/
│   ├── 📂 Http/Controllers/     # Controllers
│   └── 📂 Models/               # Eloquent Models
├── 📂 resources/
│   ├── 📂 css/
│   │   ├── app.css              # Main CSS
│   │   ├── auth.css             # Authentication styles
│   │   └── dashboard.css        # 🎨 Dashboard styles (Enhanced)
│   ├── 📂 js/
│   │   └── app.js               # Main JavaScript
│   └── 📂 views/
│       ├── dashboard.blade.php  # 🎯 Main Dashboard (Enhanced)
│       └── auth/                # Authentication views
├── 📂 public/
│   └── 📂 build/                # Compiled assets (auto-generated)
├── 📂 database/
│   ├── 📂 migrations/           # Database migrations
│   └── 📂 seeders/              # Database seeders
├── 📄 vite.config.js            # Vite configuration
├── 📄 tailwind.config.js        # Tailwind CSS configuration
└── 📄 package.json              # Node.js dependencies
```

---

## 🐛 **Troubleshooting**

### **❌ Common Issues & Solutions:**

#### **🔴 Assets Not Loading**
```bash
# Solution: Rebuild assets
npm run build
php artisan serve
```

#### **🔴 Database Connection Error**
```bash
# Check .env file database settings
# Make sure database exists
# Run: php artisan migrate
```

#### **🔴 Permission Errors**
```bash
# Fix storage permissions (Linux/Mac)
chmod -R 775 storage bootstrap/cache

# Clear caches
php artisan optimize:clear
```

#### **🔴 NPM Install Errors**
```bash
# Clear npm cache
npm cache clean --force

# Delete node_modules and reinstall
rm -rf node_modules package-lock.json
npm install
```

---

## 📚 **Documentation Links**

- 📖 **Laravel Documentation**: [https://laravel.com/docs](https://laravel.com/docs)
- 🎨 **Tailwind CSS**: [https://tailwindcss.com/docs](https://tailwindcss.com/docs)
- ⚡ **Vite**: [https://vitejs.dev/guide](https://vitejs.dev/guide)
- 📋 **Feature Documentation**: `PENJELASAN_FITUR.md`
- 🔄 **Update Summary**: `UPDATE_SUMMARY.md`

---

## 👥 **Contributing**

1. Fork the repository
2. Create feature branch: `git checkout -b feature/amazing-feature`
3. Commit changes: `git commit -m 'Add amazing feature'`
4. Push to branch: `git push origin feature/amazing-feature`
5. Open Pull Request

---

## 📄 **License**

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

## 🙏 **About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
