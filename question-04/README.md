# Soal 4 — Fungsi HelloWorld

## Deskripsi
Fungsi `helloworld($n)` menampilkan deret bilangan 1 sampai `$n` dengan ketentuan khusus.

## Ketentuan
| Kondisi | Output |
|---------|--------|
| Kelipatan 4 | `hello` |
| Kelipatan 5 | `world` |
| Kelipatan 4 dan 5 (kelipatan 20) | `helloworld` |
| Selain itu | angka itu sendiri |

## Function Signature
```php
function helloworld(int $n): string
```

## Contoh Output
```
helloworld(1)  => 1
helloworld(2)  => 1 2
helloworld(3)  => 1 2 3
helloworld(4)  => 1 2 3 hello
helloworld(5)  => 1 2 3 hello world
helloworld(6)  => 1 2 3 hello world 6
helloworld(20) => 1 2 3 hello world 6 7 hello 9 world 11 hello 13 14 world hello 17 18 19 helloworld
```

## Cara Menjalankan
```bash
cd question-04
php run.php
```

## Penjelasan Logika
1. **Loop dari 1 sampai n** - Iterasi setiap bilangan
2. **Cek kelipatan 4 DAN 5 dulu** - Prioritas tertinggi untuk kelipatan 20
3. **Cek kelipatan 4** - Tampilkan "hello"
4. **Cek kelipatan 5** - Tampilkan "world"
5. **Default** - Tampilkan angkanya
6. **Gabung dengan spasi** - Menggunakan `implode(' ', $result)`
