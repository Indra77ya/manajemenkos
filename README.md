# Sistem Manajemen Indekos (Kost Management System)

Aplikasi manajemen rumah kost berbasis web yang dibangun menggunakan Laravel.

## Persyaratan Sistem

Pastikan server atau lingkungan lokal Anda memiliki:

*   PHP >= 8.2
*   Composer
*   Node.js & NPM
*   MySQL

## Panduan Instalasi (Development)

Berikut adalah langkah-langkah untuk menjalankan aplikasi di lingkungan lokal (local machine):

1.  **Clone Repositori**
    ```bash
    git clone <repository_url>
    cd <repository_folder>
    ```

2.  **Instal Dependensi PHP**
    ```bash
    composer install
    ```

3.  **Instal Dependensi Frontend**
    ```bash
    npm install
    ```

4.  **Konfigurasi Environment**
    Salin file contoh konfigurasi `.env`:
    ```bash
    cp .env.example .env
    ```

    Buka file `.env` dan sesuaikan konfigurasi database MySQL Anda:
    ```ini
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database_kost
    DB_USERNAME=root
    DB_PASSWORD=password_db_anda
    ```
    *Pastikan Anda telah membuat database kosong dengan nama yang sesuai di MySQL.*

5.  **Generate Application Key**
    ```bash
    php artisan key:generate
    ```

6.  **Migrasi Database dan Seeder**
    Jalankan perintah ini untuk membuat tabel dan mengisi data awal (akun default):
    ```bash
    php artisan migrate --seed
    ```

7.  **Jalankan Aplikasi**
    Anda perlu menjalankan dua terminal terpisah:

    *   Terminal 1 (Server Laravel):
        ```bash
        php artisan serve
        ```
    *   Terminal 2 (Vite Build/Hot Reload):
        ```bash
        npm run dev
        ```

    Akses aplikasi melalui browser di `http://localhost:8000`.

## Panduan Instalasi (Production)

Untuk menyebarkan aplikasi ke server produksi:

1.  **Instal Dependensi (Tanpa Dev)**
    ```bash
    composer install --optimize-autoloader --no-dev
    ```

2.  **Konfigurasi Environment**
    Pastikan `.env` diset untuk produksi:
    ```ini
    APP_ENV=production
    APP_DEBUG=false
    ```

3.  **Build Aset Frontend**
    ```bash
    npm run build
    ```

4.  **Cache Konfigurasi & Route**
    ```bash
    php artisan config:cache
    php artisan route:cache
    php artisan view:cache
    ```

5.  **Migrasi Database**
    ```bash
    php artisan migrate --force
    ```
    *Catatan: Gunakan `--seed` hanya jika ini adalah instalasi pertama kali dan Anda membutuhkan data awal.*

6.  **Hak Akses Folder**
    Pastikan folder storage dan cache dapat ditulis oleh web server (misalnya www-data):
    ```bash
    chmod -R 775 storage bootstrap/cache
    ```

## Akun Default

Setelah menjalankan `php artisan migrate --seed`, Anda dapat masuk menggunakan akun berikut:

| Peran (Role) | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@example.com` | `password` |
| **Tenant** | `tenant@example.com` | `password` |
