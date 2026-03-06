# 🔧 Troubleshooting Error Deployment - QueryException

## ❌ Error yang Terjadi

```
Illuminate\Database\QueryException
in /app/vendor/laravel/framework/src/Illuminate/Database/Connection.php (line 760)
Model::all()
in /app/app/Http/Controllers/PublicController.php (line 13)
```

## 🔍 Penyebab Error

Error ini terjadi karena aplikasi mencoba mengakses tabel `categories` di database, tetapi:

1. **Migration belum dijalankan** - Tabel belum dibuat di database
2. **Koneksi database salah** - Konfigurasi database di `.env` tidak benar
3. **Database belum dibuat** - Database belum dibuat di hosting

## ✅ Solusi

### **SOLUSI 1: Jalankan Migration (PALING PENTING!)**

#### 🚂 **UNTUK RAILWAY (Cara Termudah)**

**Cara 1: Menggunakan Railway Dashboard (Direkomendasikan)**

1. Login ke [Railway Dashboard](https://railway.app)
2. Pilih project Anda
3. Pilih service yang berjalan Laravel Anda
4. Klik tab **"Deployments"** atau **"Settings"**
5. Cari bagian **"Deploy Command"** atau **"Start Command"**
6. Pastikan command deploy Anda adalah:
   ```bash
   php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
   ```
   Atau jika menggunakan buildpack, tambahkan di **"Deploy Command"**:
   ```bash
   php artisan migrate --force
   ```

**Cara 2: Menggunakan Railway CLI**

1. Install Railway CLI (jika belum):
   ```bash
   npm i -g @railway/cli
   ```

2. Login ke Railway:
   ```bash
   railway login
   ```

3. Link project Anda:
   ```bash
   railway link
   ```

4. Jalankan migration:
   ```bash
   railway run php artisan migrate --force
   ```

5. (Opsional) Jalankan seeder:
   ```bash
   railway run php artisan db:seed --force
   ```

**Cara 3: Menggunakan Railway Console/Shell**

1. Di Railway Dashboard, pilih service Anda
2. Klik tab **"View Logs"** atau **"Shell"**
3. Buka **"Console"** atau **"Terminal"**
4. Jalankan command:
   ```bash
   php artisan migrate --force
   ```

**Cara 4: Setup Auto-Migration di Railway**

Tambahkan di file `railway.json` atau di **Deploy Command** di Railway Dashboard:

```json
{
  "build": {
    "builder": "NIXPACKS"
  },
  "deploy": {
    "startCommand": "php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT",
    "restartPolicyType": "ON_FAILURE",
    "restartPolicyMaxRetries": 10
  }
}
```

Atau di Railway Dashboard, set **Deploy Command** menjadi:
```bash
php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=$PORT
```

---

#### Jika Anda punya akses SSH (untuk hosting lain):

1. Login ke server via SSH
2. Masuk ke folder project:
```bash
cd ~/public_html
# atau
cd /var/www/html/nama-project
```

3. Jalankan migration:
```bash
php artisan migrate --force
```

4. (Opsional) Jalankan seeder jika ada:
```bash
php artisan db:seed --force
```

#### Jika TIDAK punya akses SSH:

**Opsi A: Import Database via phpMyAdmin**

1. Buka **phpMyAdmin** di cPanel
2. Pilih database Anda
3. Klik tab **"SQL"**
4. Jalankan query berikut satu per satu (atau import file SQL):

```sql
-- Buat tabel categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Buat tabel books
CREATE TABLE IF NOT EXISTS `books` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `book_code` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'in stock',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Buat tabel users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'inactive',
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Buat tabel roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Buat tabel book_category (pivot table)
CREATE TABLE IF NOT EXISTS `book_category` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `book_category_book_id_foreign` (`book_id`),
  KEY `book_category_category_id_foreign` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Buat tabel rent_logs
CREATE TABLE IF NOT EXISTS `rent_logs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `book_id` bigint(20) UNSIGNED NOT NULL,
  `rent_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `actual_return_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `rent_logs_user_id_foreign` (`user_id`),
  KEY `rent_logs_book_id_foreign` (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
```

**Opsi B: Export Database dari Lokal dan Import ke Server**

1. Di komputer lokal, export database:
   - Buka phpMyAdmin lokal
   - Pilih database
   - Klik "Export" → "Go"
   - Simpan file SQL

2. Di server, import database:
   - Buka phpMyAdmin di cPanel
   - Pilih database di server
   - Klik "Import"
   - Upload file SQL yang sudah diexport
   - Klik "Go"

---

### **SOLUSI 2: Periksa Konfigurasi Database di .env**

Pastikan file `.env` di server sudah dikonfigurasi dengan benar:

```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=username_database_anda
DB_PASSWORD=password_database_anda
```

**Cara cek:**
1. Buka File Manager di cPanel
2. Buka file `.env` di root project
3. Pastikan informasi database sesuai dengan yang dibuat di cPanel

**Cara mendapatkan informasi database:**
1. Masuk ke cPanel
2. Klik "MySQL Databases"
3. Lihat informasi database yang sudah dibuat

---

### **SOLUSI 3: Pastikan Database Sudah Dibuat**

1. Masuk ke cPanel
2. Klik **"MySQL Databases"**
3. Pastikan database sudah dibuat
4. Jika belum, buat database baru:
   - Masukkan nama database
   - Klik "Create Database"
   - Buat user database
   - Berikan privileges ke user

---

### **SOLUSI 4: Test Koneksi Database**

Jika ada akses SSH, test koneksi database:

```bash
php artisan tinker
```

Lalu di tinker, jalankan:
```php
DB::connection()->getPdo();
```

Jika muncul error, berarti koneksi database bermasalah.

---

## 📋 Checklist Troubleshooting

Gunakan checklist ini untuk memastikan semua sudah benar:

- [ ] Database sudah dibuat di cPanel
- [ ] User database sudah dibuat dan diberi privileges
- [ ] File `.env` sudah dikonfigurasi dengan benar
- [ ] Migration sudah dijalankan (atau tabel sudah dibuat)
- [ ] Koneksi database bisa diakses

---

## 🚨 Jika Masih Error

### 1. Cek Log Laravel

Buka file `storage/logs/laravel.log` dan cari error terakhir untuk detail lebih lanjut.

### 2. Cek Error Log Server

Di cPanel, buka **"Error Log"** untuk melihat error dari server.

### 3. Hubungi Support Hosting

Jika semua sudah dicek tapi masih error, hubungi support hosting Anda dengan informasi:
- Error message lengkap
- File `.env` (sembunyikan password)
- Log error dari Laravel

---

## 💡 Tips Pencegahan

Untuk menghindari error ini di masa depan:

1. **Selalu jalankan migration setelah deployment**
2. **Backup database sebelum update**
3. **Test koneksi database sebelum deploy**
4. **Gunakan environment yang berbeda untuk development dan production**

---

## 📞 Butuh Bantuan Lebih Lanjut?

Jika masih mengalami masalah, siapkan informasi berikut:
- Screenshot error lengkap
- Isi file `.env` (sembunyikan password)
- Log dari `storage/logs/laravel.log`
- Informasi hosting yang digunakan
