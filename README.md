# Test Programmer TATI - Oktavian

Repository ini berisi solusi untuk tes teknis programmer yang terdiri dari 4 soal dengan berbagai tingkat kompleksitas.

## Tech Stack

- **Bahasa**: PHP 8.2+
- **Framework**: Laravel 12 (untuk Question 01 & 02)
- **Database**: SQLite (default)
- **Frontend**: Blade + Tailwind CSS + Alpine.js

## Struktur Folder

```
/Test-ProgrammerTATI-Oktavian
│
├── /question-01          # Laravel - Sistem Log Harian Pegawai
│   ├── app/
│   ├── database/
│   ├── routes/
│   └── README.md
│
├── /question-02          # Laravel - REST API Provinsi Indonesia
│   ├── app/
│   ├── database/
│   ├── routes/
│   └── README.md
│
├── /question-03          # PHP - Fungsi Predikat Kinerja Pegawai
│   ├── PerformanceHelper.php
│   ├── run.php
│   └── README.md
│
└── /question-04          # PHP - Fungsi HelloWorld
    ├── HelloWorldHelper.php
    ├── run.php
    └── README.md
```

## Daftar Soal

### Question 01 — Sistem Log Harian Pegawai
Aplikasi web berbasis Laravel untuk mengelola log harian pegawai dengan hierarki organisasi (Kepala Dinas → Kepala Bidang → Staff). Fitur utama meliputi:
- CRUD log harian dengan status (Pending/Disetujui/Ditolak)
- Verifikasi log oleh atasan langsung
- Dashboard berbasis role
- Filter & pencarian

[Lihat Detail](question-01/README.md)

### Question 02 — REST API Provinsi Indonesia
REST API menggunakan Laravel untuk operasi CRUD data provinsi Indonesia dengan endpoint:
- `GET /api/provinsi` - List semua provinsi
- `GET /api/provinsi/{id}` - Detail provinsi
- `POST /api/provinsi` - Tambah provinsi baru
- `PUT /api/provinsi/{id}` - Update provinsi
- `DELETE /api/provinsi/{id}` - Hapus provinsi

[Lihat Detail](question-02/README.md)

### Question 03 — Fungsi Predikat Kinerja Pegawai
Fungsi PHP `predikat_kinerja($hasil_kerja, $perilaku)` untuk menentukan predikat kinerja periodik pegawai berdasarkan matriks kombinasi hasil kerja dan perilaku.

```bash
cd question-03 && php run.php
```

[Lihat Detail](question-03/README.md)

### Question 04 — Fungsi HelloWorld
Fungsi PHP `helloworld($n)` yang menampilkan deret bilangan 1 sampai n dengan ketentuan:
- Kelipatan 4 → "hello"
- Kelipatan 5 → "world"
- Kelipatan 4 dan 5 → "helloworld"

```bash
cd question-04 && php run.php
```

[Lihat Detail](question-04/README.md)

## Cara Menjalankan

### Prasyarat
- PHP >= 8.2
- Composer
- Node.js & NPM (opsional)

### Question 01 & 02 (Laravel)
```bash
cd question-01  # atau question-02
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

### Question 03 & 04 (PHP Native)
```bash
cd question-03  # atau question-04
php run.php
```

## Author

**Oktavian** - Test Programmer TATI