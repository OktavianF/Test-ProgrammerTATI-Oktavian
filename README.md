### Struktur Folder

```
/interview-questions
│
├── /question-1
│   ├── solution.py
│   ├── README.md
│   └── tests.py
│
├── /question-2
│   ├── solution.py
│   ├── README.md
│   └── tests.py
│
├── /question-3
│   ├── solution.py
│   ├── README.md
│   └── tests.py
│
└── /common
    ├── utils.py
    └── constants.py
```

### Penjelasan Struktur Folder

1. **/interview-questions**: Folder utama yang berisi semua soal interview.
  
2. **/question-n**: Setiap soal interview ditempatkan dalam folder terpisah. Ini membantu menjaga kode terorganisir dan memudahkan pemeliharaan.

   - **solution.py**: File ini berisi solusi untuk soal tersebut. Pastikan untuk menulis kode yang bersih dan mudah dibaca.
   - **README.md**: File ini menjelaskan soal, pendekatan yang diambil, dan cara menjalankan solusi. Ini juga bisa berisi contoh input dan output.
   - **tests.py**: File ini berisi unit tests untuk memastikan bahwa solusi berfungsi dengan baik. Gunakan framework testing seperti `unittest` atau `pytest`.

3. **/common**: Folder ini bisa digunakan untuk menyimpan kode yang digunakan bersama di beberapa soal, seperti fungsi utilitas atau konstanta yang sering dipakai.

### Tips untuk Clean Code

- **Penamaan yang Jelas**: Gunakan nama variabel, fungsi, dan kelas yang deskriptif.
- **Fungsi Kecil**: Pecah kode menjadi fungsi-fungsi kecil yang melakukan satu tugas dengan baik.
- **Komentar yang Relevan**: Tambahkan komentar yang menjelaskan bagian-bagian yang kompleks, tetapi hindari komentar yang berlebihan.
- **Format Kode**: Gunakan formatter seperti `black` untuk Python agar kode Anda terformat dengan baik.
- **Dokumentasi**: Sertakan docstring pada fungsi dan kelas untuk menjelaskan tujuan dan cara penggunaannya.

Dengan mengikuti struktur folder dan prinsip clean code di atas, Anda akan lebih mudah dalam mengelola dan memahami solusi untuk setiap soal interview.