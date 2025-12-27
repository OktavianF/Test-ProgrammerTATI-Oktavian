# Soal 3 — Fungsi Predikat Kinerja Pegawai

## Deskripsi
Fungsi `predikat_kinerja($hasil_kerja, $perilaku)` menentukan predikat kinerja periodik pegawai berdasarkan matriks berikut:

## Matriks Predikat Kinerja

| Hasil Kerja ↓ \ Perilaku → | dibawah ekspektasi | sesuai ekspektasi | diatas ekspektasi |
|----------------------------|-------------------|-------------------|-------------------|
| **diatas ekspektasi**      | Kurang/misconduct | Baik              | Sangat Baik       |
| **sesuai ekspektasi**      | Kurang/misconduct | Baik              | Baik              |
| **di bawah ekspektasi**    | Sangat Kurang     | Butuh perbaikan   | Butuh perbaikan   |

## Function Signature
```php
function predikat_kinerja(string $hasil_kerja, string $perilaku): string
```

## Parameter
| Parameter      | Type   | Nilai yang Valid                                              |
|---------------|--------|---------------------------------------------------------------|
| `$hasil_kerja` | string | 'diatas ekspektasi', 'sesuai ekspektasi', 'dibawah ekspektasi' |
| `$perilaku`    | string | 'dibawah ekspektasi', 'sesuai ekspektasi', 'diatas ekspektasi'  |

## Contoh Penggunaan
```php
require_once 'PerformanceHelper.php';

// Contoh dari soal
echo predikat_kinerja('diatas ekspektasi', 'diatas ekspektasi'); 
// Output: Sangat Baik

// Contoh lainnya
echo predikat_kinerja('sesuai ekspektasi', 'sesuai ekspektasi');
// Output: Baik

echo predikat_kinerja('di bawah ekspektasi', 'dibawah ekspektasi');
// Output: Sangat Kurang
```

## Cara Menjalankan
```bash
cd question-03
php run.php
```

## Penjelasan Logika
1. **Normalisasi Input**: Input di-lowercase dan di-trim untuk menghindari kesalahan penulisan
2. **Matriks 2D**: Menggunakan array asosiatif 2 dimensi untuk memetakan kombinasi hasil kerja dan perilaku ke predikat
3. **Validasi**: Mengembalikan pesan error jika input tidak valid

