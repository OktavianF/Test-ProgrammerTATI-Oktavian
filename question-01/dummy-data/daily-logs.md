# Data Dummy Log Harian (Per Role)

File ini berisi contoh entri log harian untuk tiap role agar bisa diuji.

Format kolom:
- Tanggal, Aktivitas, Status, Diverifikasi Oleh, Catatan

---

## Kepala Dinas (auto-approve)
| Tanggal | Aktivitas | Status | Diverifikasi Oleh | Catatan |
|---|---|---|---|---|
| 2025-12-22 | Rapat koordinasi lintas dinas | Approved (Otomatis) | kepala.dinas@pemda.go.id | - |
| 2025-12-23 | Monitoring proyek infrastruktur | Approved (Otomatis) | kepala.dinas@pemda.go.id | - |
| 2025-12-24 | Audiensi dengan pemangku kepentingan | Approved (Otomatis) | kepala.dinas@pemda.go.id | - |
| 2025-12-25 | Peninjauan kesiapan layanan publik libur | Approved (Otomatis) | kepala.dinas@pemda.go.id | - |

---

## Kepala Bidang A
| Tanggal | Aktivitas | Status | Diverifikasi Oleh | Catatan |
|---|---|---|---|---|
| 2025-12-22 | Penyusunan rencana kerja bidang | Pending | kepala.bidang1@pemda.go.id | Butuh validasi anggaran |
| 2025-12-23 | Koordinasi staf pelaksana | Approved | kepala.bidang1@pemda.go.id | - |
| 2025-12-24 | Evaluasi progres program | Pending | kepala.bidang1@pemda.go.id | Menunggu data tambahan |
| 2025-12-25 | Supervisi kegiatan lapangan | Approved | kepala.bidang1@pemda.go.id | - |

---

## Kepala Bidang B
| Tanggal | Aktivitas | Status | Diverifikasi Oleh | Catatan |
|---|---|---|---|---|
| 2025-12-22 | Rapat teknis pelaksanaan | Pending | kepala.bidang2@pemda.go.id | Usulkan penjadwalan ulang |
| 2025-12-23 | Pelatihan internal | Approved | kepala.bidang2@pemda.go.id | Sertifikat disiapkan |
| 2025-12-24 | Penyusunan laporan triwulan | Pending | kepala.bidang2@pemda.go.id | Perlu verifikasi data |

---

## Staff A
| Tanggal | Aktivitas | Status | Diverifikasi Oleh | Catatan |
|---|---|---|---|---|
| 2025-12-22 | Pengumpulan data statistik | Pending | kepala.bidang1@pemda.go.id | Butuh cek duplikasi |
| 2025-12-23 | Verifikasi dokumen masyarakat | Approved | kepala.bidang1@pemda.go.id | - |
| 2025-12-24 | Pembuatan laporan kegiatan | Pending | kepala.bidang1@pemda.go.id | Revisi struktur laporan |

---

## Staff B
| Tanggal | Aktivitas | Status | Diverifikasi Oleh | Catatan |
|---|---|---|---|---|
| 2025-12-22 | Pendampingan layanan publik | Approved | kepala.bidang2@pemda.go.id | - |
| 2025-12-23 | Pengolahan data survei | Pending | kepala.bidang2@pemda.go.id | Butuh konfirmasi input |
| 2025-12-25 | Pengarsipan administrasi | Approved | kepala.bidang2@pemda.go.id | - |

---

## Catatan penggunaan
- Salin tabel ini untuk diuji pada form input atau sebagai contoh seed.
- Untuk `Kepala Dinas`, status selalu `Approved (Otomatis)` dan `Diverifikasi Oleh` diisi dengan email kepala sendiri.

