# Sistem Log Harian Pegawai - Pemerintah Daerah X

Aplikasi web untuk mengelola log harian pegawai berbasis hierarki organisasi. Sistem ini memungkinkan pegawai untuk mencatat aktivitas harian dan atasan untuk memverifikasi log bawahan langsung.

## Deskripsi

Sistem ini dibangun untuk memenuhi kebutuhan pencatatan dan verifikasi log harian pegawai di lingkungan Pemerintah Daerah X dengan struktur hierarki:

```
Kepala Dinas
├── Kepala Bidang 1
│   └── Staff 1
└── Kepala Bidang 2
    └── Staff 2
```

## Fitur

### Fitur Inti
1. **User & Hierarki**
   - Model User dengan role (kepala_dinas, kepala_bidang, staff)
   - Relasi supervisor_id untuk hierarki organisasi
   - 5 akun demo sesuai struktur organisasi

2. **Log Harian (CRUD)**
   - Buat, lihat, edit, hapus log harian
   - Status: Pending → Disetujui / Ditolak
   - Log hanya bisa diedit saat status masih Pending
   - Histori log pribadi

3. **Verifikasi Log**
   - Atasan hanya bisa melihat log bawahan langsung
   - Approve / Reject dengan catatan verifikasi
   - Log menjadi read-only setelah diverifikasi

### Fitur Improvisasi
- **Dashboard Berbasis Role**: Statistik berbeda untuk Staff dan Atasan
- **Filter & Pencarian**: Filter tanggal, status, dan pencarian keyword
- **Audit Trail**: verified_by, verified_at, approval_note
- **Akses Kontrol**: Middleware + Policy untuk authorization
- **UX Micro-Improvement**: Badge berwarna, konfirmasi modal

## Tech Stack

- **Framework**: Laravel 12
- **Database**: SQLite (default)
- **Frontend**: Blade + Tailwind CSS (CDN)
- **JavaScript**: Alpine.js (CDN)

## Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM (opsional)

### Langkah Instalasi

```bash
# 1. Masuk ke direktori project
cd question-01

# 2. Install dependencies
composer install

# 3. Copy file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Jalankan migrasi dan seeder
php artisan migrate --seed

# 6. Jalankan development server
php artisan serve
```

Buka browser dan akses: `http://localhost:8000`

## Akun Demo

| Role | Email | Password |
|------|-------|----------|
| Kepala Dinas | kepala.dinas@pemda.go.id | password |
| Kepala Bidang 1 | kepala.bidang1@pemda.go.id | password |
| Kepala Bidang 2 | kepala.bidang2@pemda.go.id | password |
| Staff 1 | staff1@pemda.go.id | password |
| Staff 2 | staff2@pemda.go.id | password |

### Hierarki Akun
- **Kepala Dinas** → Log otomatis disetujui (tanpa verifikasi)
- **Kepala Bidang 1** dapat memverifikasi log dari Staff 1
- **Kepala Bidang 2** dapat memverifikasi log dari Staff 2
- **Staff** tidak memiliki bawahan, hanya bisa membuat log pribadi

## Alur Bisnis

### Untuk Staff / Kepala Bidang
1. Login dengan akun staff atau kepala bidang
2. Buat log harian dengan mengisi tanggal dan aktivitas
3. Log akan berstatus **Pending** menunggu verifikasi atasan
4. Selama Pending, log masih bisa diedit atau dihapus
5. Setelah diverifikasi (Disetujui/Ditolak), log menjadi read-only

### Untuk Kepala Dinas (Perilaku Khusus)
1. Login dengan akun Kepala Dinas
2. Buat log harian dengan mengisi tanggal dan aktivitas
3. Log **langsung berstatus Disetujui** (auto-approved)
4. Tidak perlu menunggu verifikasi siapa pun
5. Log tetap bisa diedit atau dihapus oleh Kepala Dinas
6. Kolom "Diverifikasi Oleh" menampilkan **"Otomatis (Kepala Dinas)"**

> **Catatan**: Kepala Dinas adalah jabatan tertinggi dalam hierarki, sehingga log hariannya tidak memerlukan proses verifikasi dari atasan.

### Untuk Atasan (Kepala Bidang / Kepala Dinas)
1. Login dengan akun atasan
2. Lihat dashboard untuk statistik bawahan
3. Akses menu "Verifikasi" untuk melihat log bawahan
4. Klik "Verifikasi" pada log yang Pending
5. Pilih **Setujui** atau **Tolak** dengan catatan opsional
6. Atasan juga bisa membuat log harian sendiri

## Struktur Project

```
question-01/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AuthController.php
│   │   │   ├── DashboardController.php
│   │   │   ├── DailyLogController.php
│   │   │   └── VerificationController.php
│   │   ├── Middleware/
│   │   │   └── EnsureUserHasSubordinates.php
│   │   └── Requests/
│   │       ├── StoreDailyLogRequest.php
│   │       ├── UpdateDailyLogRequest.php
│   │       └── VerifyDailyLogRequest.php
│   ├── Models/
│   │   ├── User.php
│   │   └── DailyLog.php
│   └── Policies/
│       └── DailyLogPolicy.php
├── database/
│   ├── migrations/
│   │   ├── *_add_role_and_supervisor_to_users_table.php
│   │   └── *_create_daily_logs_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php
│       ├── auth/
│       │   └── login.blade.php
│       ├── daily-logs/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── verifications/
│       │   ├── index.blade.php
│       │   └── show.blade.php
│       └── dashboard.blade.php
└── routes/
    └── web.php
```

## Screenshots

### Dashboard Staff
- Total log bulan ini
- Jumlah pending, disetujui, ditolak
- Log terbaru

### Dashboard Atasan
- Statistik bawahan
- Quick access ke verifikasi
- Jumlah log pending bawahan

## Authorization

### Middleware
- `auth` - Memastikan user sudah login
- `guest` - Hanya untuk user yang belum login
- `has.subordinates` - Hanya untuk user yang memiliki bawahan

### Policy (DailyLogPolicy)
- `view` - User bisa lihat log sendiri atau bawahan langsung
- `create` - Semua user bisa membuat log
- `update` - Pemilik log pending, atau Kepala Dinas untuk log auto-approved miliknya
- `delete` - Pemilik log pending, atau Kepala Dinas untuk log auto-approved miliknya
- `verify` - Hanya atasan langsung dari pemilik log (tidak berlaku untuk log Kepala Dinas)

## API Routes

| Method | URI | Action | Middleware |
|--------|-----|--------|------------|
| GET | /login | Login page | guest |
| POST | /login | Process login | guest |
| POST | /logout | Logout | auth |
| GET | /dashboard | Dashboard | auth |
| GET | /daily-logs | List logs | auth |
| GET | /daily-logs/create | Create form | auth |
| POST | /daily-logs | Store log | auth |
| GET | /daily-logs/{id} | Show log | auth |
| GET | /daily-logs/{id}/edit | Edit form | auth |
| PUT | /daily-logs/{id} | Update log | auth |
| DELETE | /daily-logs/{id} | Delete log | auth |
| GET | /verifications | List subordinate logs | auth, has.subordinates |
| GET | /verifications/{id} | Show verification form | auth, has.subordinates |
| POST | /verifications/{id} | Process verification | auth, has.subordinates |

---

Dibuat dengan ❤️ untuk Test Programmer TATI
