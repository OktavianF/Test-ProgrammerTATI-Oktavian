<?php

declare(strict_types=1);

/**
 * HelloWorld Helper
 * 
 * Fungsi untuk menampilkan deret bilangan dengan aturan khusus.
 */

/**
 * Menampilkan deret bilangan 1 sampai $n dengan ketentuan:
 * - Kelipatan 4: tampilkan "hello"
 * - Kelipatan 5: tampilkan "world"  
 * - Kelipatan 4 dan 5 (kelipatan 20): tampilkan "helloworld"
 * - Selain itu: tampilkan angkanya
 *
 * @param int $n Batas akhir deret (harus positif)
 * @return string Deret bilangan yang sudah diformat
 */
function helloworld(int $n): string
{
    // Validasi input
    if ($n < 1) {
        return 'Input harus bilangan positif (>= 1)';
    }

    $result = [];

    for ($i = 1; $i <= $n; $i++) {
        $isMultipleOf4 = ($i % 4 === 0);
        $isMultipleOf5 = ($i % 5 === 0);

        if ($isMultipleOf4 && $isMultipleOf5) {
            // Kelipatan 4 dan 5 (kelipatan 20)
            $result[] = 'helloworld';
        } elseif ($isMultipleOf4) {
            // Kelipatan 4 saja
            $result[] = 'hello';
        } elseif ($isMultipleOf5) {
            // Kelipatan 5 saja
            $result[] = 'world';
        } else {
            // Bukan kelipatan 4 atau 5
            $result[] = (string) $i;
        }
    }

    return implode(' ', $result);
}
