# 📚 Panduan Deployment untuk Pemula - Sistem Informasi Perpustakaan

## 🎯 Apa itu Deployment?

Deployment adalah proses memindahkan aplikasi yang sudah Anda buat di komputer lokal ke server yang bisa diakses oleh semua orang melalui internet. Bayangkan seperti memindahkan toko dari gudang pribadi ke lokasi yang bisa dikunjungi pelanggan.

---

## 🤔 Pilih Jenis Hosting Anda

Sebelum mulai, tentukan dulu jenis hosting yang akan digunakan:

### 1. **Shared Hosting** (Lebih Mudah untuk Pemula)
- ✅ Lebih mudah setup
- ✅ Lebih murah
- ✅ Provider biasanya sudah menyediakan panel kontrol
- ❌ Lebih terbatas dalam konfigurasi
- **Contoh**: Niagahoster, Rumahweb, Hostinger

### 2. **VPS (Virtual Private Server)** (Lebih Fleksibel)
- ✅ Kontrol penuh
- ✅ Lebih cepat
- ❌ Perlu setup manual
- ❌ Perlu pengetahuan teknis lebih
- **Contoh**: DigitalOcean, Vultr, AWS

**💡 Untuk Pemula: Saya sarankan mulai dengan Shared Hosting dulu!**

---

## 📋 PERSIAPAN: Yang Harus Disiapkan Sebelum Deployment

### 1. **Akun Hosting**
- Sudah punya akun hosting? ✅
- Sudah punya domain? ✅
- Sudah punya database? ✅

### 2. **Informasi yang Perlu Anda Siapkan:**
- **Nama domain**: contoh: `perpustakaan.com`
- **Username database**: biasanya dari panel hosting
- **Password database**: biasanya dari panel hosting
- **Nama database**: biasanya dari panel hosting
- **Host database**: biasanya `localhost` atau IP server

### 3. **Tools yang Diperlukan:**
- **FileZilla** (untuk upload file) - Download: https://filezilla-project.org/
- **Notepad++** atau text editor lainnya (untuk edit file)
- **Akses SSH** (jika menggunakan VPS) - biasanya dari panel hosting

---

## 🚀 LANGKAH-LANGKAH DEPLOYMENT (Shared Hosting)

### **LANGKAH 1: Persiapan File di Komputer Anda**

#### 1.1. Build Assets untuk Production
Buka **Command Prompt** atau **PowerShell** di folder project Anda, lalu jalankan:

```bash
# Install dependencies (jika belum)
npm install

# Build assets untuk production
npm run production
```

**Penjelasan**: Ini akan mengkompilasi file CSS dan JavaScript agar lebih cepat diakses.

#### 1.2. Siapkan File untuk Upload
File yang **HARUS** diupload:
- ✅ Semua folder: `app`, `bootstrap`, `config`, `database`, `public`, `resources`, `routes`, `storage`
- ✅ Semua file di root: `artisan`, `composer.json`, `composer.lock`, `package.json`, dll

File yang **TIDAK PERLU** diupload:
- ❌ Folder `vendor` (akan diinstall di server)
- ❌ Folder `node_modules` (tidak diperlukan di server)
- ❌ File `.env` (akan dibuat di server)
- ❌ Folder `.git` (jika ada)

**💡 Tips**: Buat folder baru, copy semua file yang diperlukan ke sana, lalu zip folder tersebut.

---

### **LANGKAH 2: Upload File ke Server**

#### 2.1. Login ke cPanel atau Panel Hosting Anda
- Masuk ke akun hosting Anda
- Buka **File Manager** atau gunakan **FileZilla**

#### 2.2. Upload File
- **Jika menggunakan FileZilla:**
  1. Buka FileZilla
  2. Masukkan:
     - **Host**: `ftp.namadomain.com` (cek di panel hosting)
     - **Username**: username hosting Anda
     - **Password**: password hosting Anda
     - **Port**: 21
  3. Klik "Quickconnect"
  4. Di panel kanan (server), masuk ke folder `public_html` atau `www`
  5. Upload semua file yang sudah disiapkan

- **Jika menggunakan File Manager:**
  1. Buka File Manager di cPanel
  2. Masuk ke folder `public_html`
  3. Upload file ZIP yang sudah dibuat
  4. Extract file ZIP tersebut

#### 2.3. PENTING: Pindahkan Isi Folder `public` ke Root
Laravel membutuhkan file di folder `public` berada di root `public_html`. 

**Cara 1 (Direkomendasikan):**
1. Pindahkan semua isi folder `public` ke `public_html`
2. Pindahkan semua file dan folder lainnya ke satu level di atas `public_html` (biasanya folder `public_html` ada di dalam folder dengan nama domain)

**Cara 2 (Alternatif):**
1. Buat file `.htaccess` di `public_html` dengan isi:
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
```

---

### **LANGKAH 3: Buat Database**

#### 3.1. Buat Database di cPanel
1. Masuk ke cPanel
2. Klik **MySQL Databases** atau **Database**
3. Buat database baru:
   - Masukkan nama database (contoh: `perpustakaan_db`)
   - Klik "Create Database"
4. Buat user database:
   - Masukkan username (contoh: `perpustakaan_user`)
   - Masukkan password yang kuat
   - Klik "Create User"
5. Berikan semua privileges ke user untuk database tersebut
6. **CATAT INFORMASI INI:**
   - Database name: `perpustakaan_db`
   - Database username: `perpustakaan_user`
   - Database password: `password_anda`
   - Database host: biasanya `localhost`

---

### **LANGKAH 4: Install Composer Dependencies**

#### 4.1. Akses SSH (jika tersedia)
1. Di cPanel, buka **Terminal** atau **SSH Access**
2. Masuk ke folder project Anda:
```bash
cd public_html
# atau
cd ~/public_html
```

#### 4.2. Install Dependencies
```bash
# Install Composer dependencies
composer install --optimize-autoloader --no-dev
```

**Penjelasan**: Ini akan menginstall semua library PHP yang diperlukan aplikasi.

**⚠️ Jika tidak ada akses SSH:**
- Upload folder `vendor` dari komputer lokal Anda (setelah menjalankan `composer install` di lokal)
- Atau gunakan layanan seperti **Deployer** atau minta bantuan support hosting

---

### **LANGKAH 5: Buat dan Konfigurasi File .env**

#### 5.1. Buat File .env
1. Di File Manager atau FileZilla, buat file baru bernama `.env`
2. Copy isi file `.env.example` (jika ada) atau buat baru

#### 5.2. Edit File .env
Buka file `.env` dan edit dengan informasi Anda:

```env
APP_NAME="Sistem Informasi Perpustakaan"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://namadomain.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=perpustakaan_db
DB_USERNAME=perpustakaan_user
DB_PASSWORD=password_anda

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=email@gmail.com
MAIL_PASSWORD=password_email
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@namadomain.com"
MAIL_FROM_NAME="${APP_NAME}"
```

**⚠️ PENTING:**
- Ganti `namadomain.com` dengan domain Anda
- Ganti informasi database dengan yang Anda buat di Langkah 3
- **JANGAN** set `APP_DEBUG=true` di production!

#### 5.3. Generate APP_KEY
Jika ada akses SSH, jalankan:
```bash
php artisan key:generate
```

Jika tidak ada SSH, Anda bisa generate di lokal:
```bash
php artisan key:generate
```
Lalu copy nilai `APP_KEY` dari `.env` lokal ke `.env` di server.

---

### **LANGKAH 6: Setup Database**

#### 6.1. Jalankan Migration
Jika ada akses SSH:
```bash
php artisan migrate --force
```

Jika tidak ada SSH:
- Import database secara manual melalui **phpMyAdmin**:
  1. Buka phpMyAdmin di cPanel
  2. Pilih database Anda
  3. Klik tab "Import"
  4. Upload file SQL (jika ada) atau jalankan migration secara manual

#### 6.2. (Opsional) Jalankan Seeder
Jika ada data awal yang perlu diisi:
```bash
php artisan db:seed --force
```

---

### **LANGKAH 7: Setup Storage dan Permissions**

#### 7.1. Buat Symbolic Link
Jika ada akses SSH:
```bash
php artisan storage:link
```

Jika tidak ada SSH:
- Buat folder `storage` di dalam `public_html`
- Atau hubungi support hosting untuk bantuan

#### 7.2. Set Permissions
Jika ada akses SSH:
```bash
chmod -R 775 storage bootstrap/cache
```

Jika tidak ada SSH:
- Di File Manager, klik kanan folder `storage` → "Change Permissions" → set ke `775`
- Lakukan hal yang sama untuk `bootstrap/cache`

---

### **LANGKAH 8: Optimasi untuk Production**

Jika ada akses SSH, jalankan:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

**Penjelasan**: Ini akan membuat aplikasi lebih cepat dengan menyimpan cache.

---

### **LANGKAH 9: Test Aplikasi**

1. Buka browser
2. Ketik domain Anda: `https://namadomain.com`
3. Cek apakah aplikasi muncul dengan benar
4. Coba login dengan akun admin

**✅ Jika berhasil**: Selamat! Deployment Anda berhasil!

**❌ Jika ada error**: Lihat bagian Troubleshooting di bawah.

---

## 🖥️ LANGKAH-LANGKAH DEPLOYMENT (VPS)

Jika Anda menggunakan VPS, ikuti langkah-langkah berikut:

### **LANGKAH 1: Connect ke VPS via SSH**

```bash
ssh root@ip_server_anda
# atau
ssh username@ip_server_anda
```

### **LANGKAH 2: Install LAMP/LEMP Stack**

**Untuk Ubuntu/Debian:**
```bash
# Update sistem
sudo apt update && sudo apt upgrade -y

# Install Apache, MySQL, PHP
sudo apt install apache2 mysql-server php8.0 php8.0-mysql php8.0-mbstring php8.0-xml php8.0-bcmath php8.0-curl -y

# Install Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Install Node.js dan NPM
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs
```

### **LANGKAH 3: Clone atau Upload Project**

```bash
# Masuk ke folder web server
cd /var/www/html

# Clone dari Git (jika menggunakan Git)
git clone https://github.com/username/repo.git

# Atau upload via SCP/SFTP
```

### **LANGKAH 4: Install Dependencies**

```bash
cd /var/www/html/nama-project

# Install Composer
composer install --optimize-autoloader --no-dev

# Install NPM
npm install
npm run production
```

### **LANGKAH 5: Setup Database**

```bash
# Login ke MySQL
mysql -u root -p

# Buat database
CREATE DATABASE perpustakaan_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'perpustakaan_user'@'localhost' IDENTIFIED BY 'password_kuat';
GRANT ALL PRIVILEGES ON perpustakaan_db.* TO 'perpustakaan_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

### **LANGKAH 6: Konfigurasi .env**

```bash
cp .env.example .env
nano .env
# Edit sesuai kebutuhan, lalu save (Ctrl+X, Y, Enter)
```

### **LANGKAH 7: Setup Laravel**

```bash
php artisan key:generate
php artisan migrate --force
php artisan storage:link
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### **LANGKAH 8: Konfigurasi Apache/Nginx**

**Apache:**
```bash
sudo nano /etc/apache2/sites-available/perpustakaan.conf
```

Tambahkan:
```apache
<VirtualHost *:80>
    ServerName namadomain.com
    DocumentRoot /var/www/html/nama-project/public

    <Directory /var/www/html/nama-project/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Aktifkan:
```bash
sudo a2enmod rewrite
sudo a2ensite perpustakaan.conf
sudo systemctl restart apache2
```

---

## ✅ CHECKLIST DEPLOYMENT

Gunakan checklist ini untuk memastikan semua langkah sudah dilakukan:

### Persiapan
- [ ] File sudah di-build untuk production (`npm run production`)
- [ ] File sudah disiapkan untuk upload (tanpa vendor, node_modules, .env)

### Upload
- [ ] File sudah diupload ke server
- [ ] File di folder `public` sudah dipindah ke root `public_html`

### Database
- [ ] Database sudah dibuat
- [ ] User database sudah dibuat dan diberi privileges
- [ ] Informasi database sudah dicatat

### Konfigurasi
- [ ] File `.env` sudah dibuat
- [ ] File `.env` sudah dikonfigurasi dengan benar
- [ ] `APP_KEY` sudah di-generate
- [ ] `APP_DEBUG=false` sudah diset
- [ ] `APP_URL` sudah diset dengan benar

### Setup
- [ ] Composer dependencies sudah diinstall
- [ ] Migration sudah dijalankan
- [ ] Storage link sudah dibuat
- [ ] Permissions sudah diset dengan benar

### Optimasi
- [ ] Config cache sudah dibuat
- [ ] Route cache sudah dibuat
- [ ] View cache sudah dibuat

### Testing
- [ ] Aplikasi bisa diakses di browser
- [ ] Halaman login muncul
- [ ] Bisa login dengan akun admin
- [ ] Fitur utama aplikasi berfungsi

---

## 🔧 TROUBLESHOOTING (Mengatasi Masalah)

### ❌ Error: "No application encryption key has been specified"

**Solusi:**
```bash
php artisan key:generate
```
Atau edit file `.env` dan pastikan ada baris `APP_KEY=base64:...`

---

### ❌ Error: "The stream or file could not be opened"

**Solusi:**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

Atau di File Manager, set permissions folder `storage` dan `bootstrap/cache` ke `775`.

---

### ❌ Error: "SQLSTATE[HY000] [2002] Connection refused"

**Penyebab:** Database tidak bisa diakses.

**Solusi:**
1. Periksa konfigurasi database di `.env`:
   - `DB_HOST` biasanya `localhost` untuk shared hosting
   - `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` harus sesuai dengan yang dibuat di cPanel
2. Pastikan database server berjalan
3. Periksa apakah user database sudah diberi privileges

---

### ❌ Error: "404 Not Found" atau halaman kosong

**Penyebab:** File tidak di root yang benar atau `.htaccess` tidak ada.

**Solusi:**
1. Pastikan file `index.php` ada di `public_html`
2. Pastikan file `.htaccess` ada di `public_html`
3. Pastikan mod_rewrite aktif (untuk Apache)
4. Cek apakah `APP_URL` di `.env` sudah benar

---

### ❌ CSS dan JavaScript tidak muncul

**Solusi:**
1. Pastikan sudah menjalankan `npm run production`
2. Pastikan folder `public/css` dan `public/js` sudah diupload
3. Clear cache:
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

---

### ❌ Error: "Class not found" atau "Composer autoload"

**Solusi:**
1. Pastikan folder `vendor` sudah diupload atau diinstall
2. Jika ada SSH, jalankan:
```bash
composer install --optimize-autoloader --no-dev
composer dump-autoload
```

---

### ❌ Error: "Permission denied"

**Solusi:**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

Atau di File Manager, set permissions ke `775`.

---

## 📝 CATATAN PENTING UNTUK PEMULA

### ⚠️ JANGAN PERNAH:
1. ❌ Upload file `.env` ke repository Git
2. ❌ Set `APP_DEBUG=true` di production
3. ❌ Share informasi database ke orang lain
4. ❌ Lupa backup database sebelum update

### ✅ SELALU:
1. ✅ Backup database secara berkala
2. ✅ Gunakan password yang kuat untuk database
3. ✅ Update dependencies secara berkala
4. ✅ Monitor log di `storage/logs/laravel.log`
5. ✅ Gunakan HTTPS (SSL) untuk keamanan

---

## 🔄 CARA UPDATE APLIKASI SETELAH DEPLOYMENT

Jika Anda sudah melakukan perubahan dan ingin update aplikasi di server:

### 1. Backup Database Dulu!
```bash
# Di phpMyAdmin, export database
# Atau via SSH:
mysqldump -u username -p nama_database > backup.sql
```

### 2. Upload File Baru
- Upload file yang berubah saja, atau
- Upload semua file (kecuali `.env` dan `vendor`)

### 3. Update Dependencies (jika ada)
```bash
composer install --optimize-autoloader --no-dev
npm install
npm run production
```

### 4. Jalankan Migration Baru (jika ada)
```bash
php artisan migrate --force
```

### 5. Clear dan Rebuild Cache
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## 📞 BUTUH BANTUAN?

Jika masih mengalami masalah:

1. **Cek Log Laravel:**
   - File: `storage/logs/laravel.log`
   - Buka dan cari error terakhir

2. **Cek Error Log Server:**
   - Di cPanel: "Error Log"
   - Atau tanya support hosting

3. **Cek PHP Error:**
   - Pastikan PHP version >= 8.0
   - Pastikan extension PHP yang diperlukan sudah aktif

4. **Hubungi Support:**
   - Support hosting Anda
   - Atau tanya di forum Laravel Indonesia

---

## 🎉 SELAMAT!

Jika semua langkah sudah dilakukan dan aplikasi sudah bisa diakses, **SELAMAT!** Deployment Anda berhasil! 🎊

Aplikasi Sistem Informasi Perpustakaan Anda sekarang sudah online dan bisa diakses oleh semua orang!

---

**💡 Tips Terakhir:**
- Simpan semua informasi penting (database, password, dll) di tempat yang aman
- Lakukan backup secara berkala
- Monitor aplikasi secara rutin
- Update aplikasi jika ada security patch

**Semoga berhasil! 🚀**
