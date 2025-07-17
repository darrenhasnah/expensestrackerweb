# expensestrackerweb

Laravel Expenses Tracker UAS Web 2
- Darren Hasnah (03082230014)
- Vincent Frenando Tan (03082230007)


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
