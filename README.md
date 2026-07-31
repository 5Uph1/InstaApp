# InstaApp

InstaApp adalah aplikasi media sosial sederhana yang dibangun menggunakan **Laravel 12** sebagai bagian dari technical test. Aplikasi ini memungkinkan pengguna untuk melakukan autentikasi, membuat postingan, memberikan like, dan menambahkan komentar.

---

## 🚀 Tech Stack

- Laravel 12
- PHP 8.2+
- MySQL
- Laravel Breeze
- Blade
- Tailwind CSS
- Vite
- Git

---

## 📋 Prasyarat

Pastikan perangkat Anda telah terpasang:

- PHP >= 8.2
- Composer
- Node.js & npm
- MySQL (Laragon/XAMPP/MAMP atau sejenisnya)
- Git

---

# ⚙️ Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/<username>/instaapp.git
```

Masuk ke folder project.

```bash
cd instaapp
```

---

### 2. Install Dependency PHP

```bash
composer install
```

---

### 3. Install Dependency Frontend

```bash
npm install
```

---

### 4. Konfigurasi Environment

Salin file `.env`.

**Windows**

```bash
copy .env.example .env
```

**Linux / macOS**

```bash
cp .env.example .env
```

Generate application key.

```bash
php artisan key:generate
```

---

### 5. Konfigurasi Database

Buat database baru bernama:

```text
instaapp
```

Kemudian ubah konfigurasi database pada file `.env`.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=instaapp
DB_USERNAME=root
DB_PASSWORD=
```

> Sesuaikan `DB_USERNAME` dan `DB_PASSWORD` dengan konfigurasi MySQL Anda.

---

### 6. Jalankan Migration & Seeder

Jalankan migration sekaligus seeding data dummy (post, like, komentar):

```bash
php artisan migrate:fresh --seed
```

Setelah selesai, tersedia akun berikut untuk login:

```text
Email    : test@gmail.com
Password : password
```

> Perintah ini akan menghapus seluruh data di database sebelum migrate ulang. Kalau hanya ingin migrate tanpa reset data, gunakan `php artisan migrate` saja (tanpa seeding).

---

### 7. Buat Symbolic Link Storage

```bash
php artisan storage:link
```

---

# ▶️ Menjalankan Aplikasi

Jalankan Laravel.

```bash
php artisan serve
```

Jalankan Vite pada terminal lain.

```bash
npm run dev
```

Buka browser.

```
http://127.0.0.1:8000
```

Login menggunakan akun dummy (lihat Langkah 6) atau register akun baru.

---

# 📂 Struktur Project

---
```
instaapp/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/
├── resources/
├── routes/
├── storage/
├── tests/
├── .env.example
├── composer.json
├── package.json
└── README.md
```
---

# ✨ Fitur

- [x] Authentication (Register, Login, Logout)
- [x] CRUD Post
- [x] Upload Image
- [x] Like & Unlike
- [x] Comment
- [x] Authorization Policy
- [x] Responsive UI

---
