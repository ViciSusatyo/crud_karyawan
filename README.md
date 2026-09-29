# Templating — Sistem Informasi Karyawan

Contoh aplikasi **Laravel 12** untuk mempelajari Blade templating: landing page publik, login,
dashboard, dan CRUD karyawan. Styling memakai **Tailwind CSS 4** (dibangun lewat Vite) dan
**Alpine.js**, database memakai **MySQL** lokal dari XAMPP.

## Fitur

| Modul              | Keterangan                                                                     |
| ------------------ | ------------------------------------------------------------------------------ |
| Landing page       | Halaman publik berisi hero, daftar fitur, dan CTA ke login                     |
| Autentikasi        | Login/logout berbasis session, remember me, middleware `auth`                 |
| Dashboard          | Total karyawan, tambahan bulan ini, jumlah jabatan, data terbaru, rekap jabatan |
| CRUD Karyawan      | Route resource, route model binding, pencarian, pagination 10 per halaman        |
| Validasi           | Validasi server-side dengan pesan otomatis (locale `id`)                        |

## Kebutuhan

- PHP >= 8.2 (diuji pada 8.5)
- Composer 2
- Node.js 20+ (diuji pada 24)
- MySQL dari XAMPP yang sedang berjalan

## Instalasi

```bash
composer install
npm install

copy .env.example .env     # Linux/macOS
# Windows PowerShell: copy .env.example .env

php artisan key:generate
```

Buat database `templating_db` di phpMyAdmin, atau lewat CLI:

```bash
mysql -u root -e "CREATE DATABASE IF NOT EXISTS templating_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

Pastikan bagian berikut di `.env` sesuai dengan XAMPP Anda:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=templating_db
DB_USERNAME=root
DB_PASSWORD=
```

Lalu jalankan migration beserta data contoh:

```bash
php artisan migrate --seed
npm run build
```

## Menjalankan

```bash
cd "C:\xampp\htdocs\Koding\Workshop Pengembangan Website\crud_karyawan"
php artisan serve
```

Buka http://127.0.0.1:8000. Untuk pengembangan dengan hot reload, jalankan dua terminal:

```bash
npm run dev
php artisan serve
```

### Akun demo

| Email                  | Password   |
| ---------------------- | ---------- |
| `admin@templating.test` | `password` |

## Pengujian

```bash
php artisan test
```

Test memakai database SQLite in-memory, jadi tidak menyentuh database MySQL Anda.
Untuk memeriksa format kode:

```bash
./vendor/bin/pint --test
```

## Struktur Penting

```
app/
  Http/Controllers/
    AuthController.php          # login, proses login, logout
    DashboardController.php     # statistik dashboard
    KaryawanController.php      # CRUD + pencarian
  Models/Karyawan.php           # model, scope search, accessor initials
resources/views/
  landing.blade.php             # halaman publik
  auth/login.blade.php          # form login
  dashboard.blade.php           # ringkasan data
  karyawan/
    index|create|edit.blade.php
    _form.blade.php             # partial form bersama create & edit
  components/
    layouts/                    # app (sidebar), guest (login), public (landing)
    form/input.blade.php        # input + pesan error + old() value
    button|badge|stat|empty|flash|icon|logo|nav-link.blade.php
routes/web.php                  # route publik, guest, dan auth
database/
  migrations/..._create_karyawans_table.php
  factories/KaryawanFactory.php
  seeders/DatabaseSeeder.php
```

## Alur Request

1. Tamu membuka `/` atau `/login` — route berada di luar middleware `auth`.
2. Setelah login berhasil, session di-regenerate lalu pengguna diarahkan ke `/dashboard`.
3. Halaman di dalam middleware `auth` (`/dashboard`, `/karyawan/*`) hanya untuk pengguna login.
4. Perubahan data memakai `POST` + `@method('PUT'/'DELETE')` karena form HTML hanya mendukung `GET`/`POST`.
