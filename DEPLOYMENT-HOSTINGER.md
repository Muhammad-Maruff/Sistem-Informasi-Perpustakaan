# 🚀 Panduan Deployment di Hostinger - Step by Step untuk Pemula

## 📋 Persiapan

### Yang Perlu Disiapkan:
- ✅ Akun Hostinger (VPS atau Shared Hosting)
- ✅ Domain (atau subdomain)
- ✅ File aplikasi Laravel yang sudah siap
- ✅ Akses ke hPanel (Hostinger Control Panel)

---

## 🎯 Pilih Tipe Hosting Anda

### **Opsi A: VPS Hostinger (DIREKOMENDASIKAN untuk 3 Aplikasi)**
- Kontrol penuh
- Bisa install apa saja
- Performa lebih baik

### **Opsi B: Shared Hosting Hostinger**
- Lebih mudah setup
- Terbatas untuk 1-2 aplikasi
- Tidak bisa install Node.js (untuk Next.js)

**💡 Untuk 3 aplikasi, gunakan VPS Hostinger!**

---

## 🖥️ DEPLOYMENT DI VPS HOSTINGER

### **LANGKAH 1: Setup Awal VPS**

#### 1.1. Login ke hPanel Hostinger
1. Buka https://hpanel.hostinger.com
2. Login dengan akun Anda
3. Pilih VPS Anda

#### 1.2. Akses Terminal Browser
1. Di hPanel, klik **"Terminal"** atau **"Browser Terminal"**
2. Atau gunakan SSH client (PuTTY untuk Windows, Terminal untuk Mac/Linux)

#### 1.3. Update Sistem
```bash
# Untuk Ubuntu/Debian
sudo apt update && sudo apt upgrade -y

# Install tools dasar
sudo apt install git curl wget -y
```

---

### **LANGKAH 2: Install LAMP Stack**

#### 2.1. Install Apache
```bash
sudo apt install apache2 -y
sudo systemctl start apache2
sudo systemctl enable apache2
```

#### 2.2. Install MySQL
```bash
sudo apt install mysql-server -y
sudo systemctl start mysql
sudo systemctl enable mysql

# Setup MySQL security
sudo mysql_secure_installation
# Ikuti instruksi, set password root MySQL
```

#### 2.3. Install PHP 8.0+ (Laravel butuh PHP 8.0+)
```bash
# Install PHP dan extension yang diperlukan
sudo apt install php8.0 php8.0-cli php8.0-common php8.0-mysql php8.0-zip php8.0-gd php8.0-mbstring php8.0-curl php8.0-xml php8.0-bcmath -y

# Cek versi PHP
php -v
```

#### 2.4. Install Composer
```bash
cd ~
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
sudo chmod +x /usr/local/bin/composer

# Cek Composer
composer --version
```

#### 2.5. Install Node.js & NPM (untuk build assets)
```bash
curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -
sudo apt install -y nodejs

# Cek Node.js
node -v
npm -v
```

---

### **LANGKAH 3: Upload File Aplikasi**

#### 3.1. Cara 1: Upload via File Manager (Mudah untuk Pemula)

1. **Buka File Manager di hPanel**
2. **Masuk ke folder `/home/username/`** (ganti username dengan username VPS Anda)
3. **Buat folder untuk aplikasi:**
   - `perpustakaan` (untuk aplikasi 1)
   - `marketplace` (untuk aplikasi 2)
   - `pos` (untuk aplikasi 3)

4. **Upload file Laravel:**
   - Zip semua file Laravel (kecuali `vendor`, `node_modules`, `.env`)
   - Upload ZIP ke folder yang sesuai
   - Extract ZIP di server

#### 3.2. Cara 2: Clone dari Git (Jika menggunakan Git)

```bash
cd /home/username
git clone https://github.com/username/repo-perpustakaan.git perpustakaan
git clone https://github.com/username/repo-marketplace.git marketplace
git clone https://github.com/username/repo-pos.git pos
```

#### 3.3. Cara 3: Upload via SCP/SFTP

```bash
# Dari komputer lokal (Windows PowerShell atau Terminal)
scp -r C:\path\to\project root@ip_server:/home/username/perpustakaan
```

---

### **LANGKAH 4: Install Dependencies untuk Setiap Aplikasi**

```bash
# Masuk ke folder aplikasi 1
cd /home/username/perpustakaan
composer install --optimize-autoloader --no-dev
npm install
npm run production

# Masuk ke folder aplikasi 2
cd /home/username/marketplace
composer install --optimize-autoloader --no-dev
npm install
npm run production

# Masuk ke folder aplikasi 3
cd /home/username/pos
composer install --optimize-autoloader --no-dev
npm install
npm run production
```

---

### **LANGKAH 5: Setup Database**

#### 5.1. Login ke MySQL
```bash
sudo mysql -u root -p
# Masukkan password MySQL yang sudah diset
```

#### 5.2. Buat Database untuk Setiap Aplikasi
```sql
-- Database untuk aplikasi 1
CREATE DATABASE perpustakaan_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Database untuk aplikasi 2
CREATE DATABASE marketplace_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Database untuk aplikasi 3
CREATE DATABASE pos_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Buat user database (atau gunakan root untuk development)
CREATE USER 'laravel_user'@'localhost' IDENTIFIED BY 'password_kuat_anda';
GRANT ALL PRIVILEGES ON perpustakaan_db.* TO 'laravel_user'@'localhost';
GRANT ALL PRIVILEGES ON marketplace_db.* TO 'laravel_user'@'localhost';
GRANT ALL PRIVILEGES ON pos_db.* TO 'laravel_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

---

### **LANGKAH 6: Konfigurasi .env untuk Setiap Aplikasi**

#### 6.1. Buat File .env
```bash
# Untuk aplikasi 1
cd /home/username/perpustakaan
cp .env.example .env
nano .env

# Untuk aplikasi 2
cd /home/username/marketplace
cp .env.example .env
nano .env

# Untuk aplikasi 3
cd /home/username/pos
cp .env.example .env
nano .env
```

#### 6.2. Edit File .env (Contoh untuk Aplikasi 1)
```env
APP_NAME="Sistem Informasi Perpustakaan"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://perpustakaan.domain.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan_db
DB_USERNAME=laravel_user
DB_PASSWORD=password_kuat_anda
```

**Ulangi untuk aplikasi 2 dan 3 dengan database dan domain yang sesuai.**

#### 6.3. Generate APP_KEY
```bash
# Untuk setiap aplikasi
cd /home/username/perpustakaan
php artisan key:generate

cd /home/username/marketplace
php artisan key:generate

cd /home/username/pos
php artisan key:generate
```

---

### **LANGKAH 7: Setup Laravel untuk Setiap Aplikasi**

```bash
# Untuk aplikasi 1
cd /home/username/perpustakaan
php artisan migrate --force
php artisan storage:link
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Untuk aplikasi 2
cd /home/username/marketplace
php artisan migrate --force
php artisan storage:link
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Untuk aplikasi 3
cd /home/username/pos
php artisan migrate --force
php artisan storage:link
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

### **LANGKAH 8: Konfigurasi Apache Virtual Host**

#### 8.1. Buat Konfigurasi untuk Aplikasi 1
```bash
sudo nano /etc/apache2/sites-available/perpustakaan.conf
```

Isi dengan:
```apache
<VirtualHost *:80>
    ServerName perpustakaan.domain.com
    ServerAlias www.perpustakaan.domain.com
    DocumentRoot /home/username/perpustakaan/public

    <Directory /home/username/perpustakaan/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/perpustakaan_error.log
    CustomLog ${APACHE_LOG_DIR}/perpustakaan_access.log combined
</VirtualHost>
```

#### 8.2. Buat Konfigurasi untuk Aplikasi 2
```bash
sudo nano /etc/apache2/sites-available/marketplace.conf
```

Isi dengan:
```apache
<VirtualHost *:80>
    ServerName api.marketplace.domain.com
    DocumentRoot /home/username/marketplace/public

    <Directory /home/username/marketplace/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/marketplace_error.log
    CustomLog ${APACHE_LOG_DIR}/marketplace_access.log combined
</VirtualHost>
```

#### 8.3. Buat Konfigurasi untuk Aplikasi 3
```bash
sudo nano /etc/apache2/sites-available/pos.conf
```

Isi dengan:
```apache
<VirtualHost *:80>
    ServerName pos.domain.com
    DocumentRoot /home/username/pos/public

    <Directory /home/username/pos/public>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/pos_error.log
    CustomLog ${APACHE_LOG_DIR}/pos_access.log combined
</VirtualHost>
```

#### 8.4. Aktifkan Virtual Host
```bash
# Enable mod_rewrite
sudo a2enmod rewrite

# Enable virtual host
sudo a2ensite perpustakaan.conf
sudo a2ensite marketplace.conf
sudo a2ensite pos.conf

# Test konfigurasi
sudo apache2ctl configtest

# Restart Apache
sudo systemctl restart apache2
```

---

### **LANGKAH 9: Setup Domain di Hostinger**

1. **Login ke hPanel Hostinger**
2. **Masuk ke "Domains"**
3. **Tambahkan domain atau subdomain:**
   - `perpustakaan.domain.com` → Point ke IP VPS
   - `api.marketplace.domain.com` → Point ke IP VPS
   - `pos.domain.com` → Point ke IP VPS

4. **Atau gunakan DNS:**
   - Tambahkan A record untuk setiap subdomain
   - Point ke IP VPS Anda

---

### **LANGKAH 10: Setup SSL (HTTPS)**

#### 10.1. Install Certbot
```bash
sudo apt install certbot python3-certbot-apache -y
```

#### 10.2. Generate SSL Certificate
```bash
# Untuk setiap domain
sudo certbot --apache -d perpustakaan.domain.com
sudo certbot --apache -d api.marketplace.domain.com
sudo certbot --apache -d pos.domain.com
```

Certbot akan otomatis mengkonfigurasi HTTPS untuk Anda.

---

## 🌐 DEPLOYMENT DI SHARED HOSTING HOSTINGER

**⚠️ Catatan: Shared Hosting HANYA untuk 1-2 aplikasi, tidak direkomendasikan untuk 3 aplikasi!**

### **LANGKAH 1: Login ke hPanel**

1. Buka https://hpanel.hostinger.com
2. Login dengan akun Anda

### **LANGKAH 2: Upload File**

1. Buka **File Manager**
2. Masuk ke folder `public_html`
3. **Untuk aplikasi pertama:** Upload langsung ke `public_html`
4. **Untuk aplikasi kedua:** Buat subdomain, lalu upload ke folder subdomain

### **LANGKAH 3: Setup Database**

1. Di hPanel, buka **"MySQL Databases"**
2. Buat database untuk setiap aplikasi
3. Catat informasi database

### **LANGKAH 4: Konfigurasi .env**

1. Buat file `.env` di root aplikasi
2. Edit dengan informasi database dari Langkah 3
3. Generate APP_KEY via SSH (jika tersedia) atau via terminal di hPanel

### **LANGKAH 5: Install Dependencies**

**Jika ada SSH:**
```bash
cd public_html
composer install --optimize-autoloader --no-dev
npm install
npm run production
```

**Jika tidak ada SSH:**
- Upload folder `vendor` dari lokal (setelah `composer install` di lokal)
- Upload folder `public/css` dan `public/js` (setelah `npm run production`)

### **LANGKAH 6: Setup Laravel**

**Jika ada SSH:**
```bash
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

**Jika tidak ada SSH:**
- Import database via phpMyAdmin
- Set permissions via File Manager

---

## ✅ Checklist Deployment Hostinger

### Persiapan
- [ ] VPS atau Shared Hosting sudah aktif
- [ ] Domain sudah di-point ke server
- [ ] File aplikasi sudah siap

### Setup Server (VPS)
- [ ] LAMP Stack sudah terinstall
- [ ] Composer sudah terinstall
- [ ] Node.js sudah terinstall

### Setup Aplikasi
- [ ] File sudah diupload ke server
- [ ] Dependencies sudah diinstall (Composer & NPM)
- [ ] Database sudah dibuat untuk setiap aplikasi
- [ ] File `.env` sudah dibuat dan dikonfigurasi
- [ ] APP_KEY sudah di-generate
- [ ] Migration sudah dijalankan
- [ ] Storage link sudah dibuat
- [ ] Permissions sudah diset

### Konfigurasi Web Server
- [ ] Virtual Host sudah dikonfigurasi (VPS)
- [ ] Domain sudah di-point ke server
- [ ] SSL sudah di-setup (HTTPS)

### Testing
- [ ] Aplikasi 1 bisa diakses
- [ ] Aplikasi 2 bisa diakses
- [ ] Aplikasi 3 bisa diakses
- [ ] Login berfungsi
- [ ] Fitur utama berfungsi

---

## 🔧 Troubleshooting Khusus Hostinger

### ❌ Error: "Permission denied"

**Solusi:**
```bash
sudo chown -R www-data:www-data /home/username/perpustakaan
sudo chmod -R 775 /home/username/perpustakaan/storage
```

### ❌ Error: "Composer not found"

**Solusi:**
```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### ❌ Error: "Apache tidak bisa start"

**Solusi:**
```bash
sudo apache2ctl configtest
# Perbaiki error yang muncul
sudo systemctl restart apache2
```

### ❌ Error: "Domain tidak bisa diakses"

**Solusi:**
1. Cek DNS sudah di-point ke IP VPS
2. Cek virtual host sudah di-enable
3. Cek firewall (buka port 80 dan 443)

---

## 📞 Support Hostinger

Jika mengalami masalah:
1. **Live Chat Hostinger** - Tersedia 24/7
2. **Knowledge Base** - https://support.hostinger.com
3. **Community Forum** - https://community.hostinger.com

---

## 🎉 Selamat!

Jika semua langkah sudah dilakukan, aplikasi Anda sekarang sudah online di Hostinger! 🚀

**Tips:**
- Monitor resource usage di hPanel
- Setup backup otomatis
- Update aplikasi secara berkala
