<?php

/**
 * Performance Helper
 * 
 * Provides utility function to determine employee performance predicate
 * based on work results (hasil kerja) and behavior (perilaku) scores.
 */

/**
 * Determine performance predicate based on hasil_kerja and perilaku scores.
 * 
 * Scoring Matrix:
 * ┌─────────────────┬──────────────────────────────────────────────────────────────┐
 * │   Hasil Kerja   │                        Perilaku                              │
 * │                 ├────────────┬────────────┬────────────┬────────────┬──────────┤
 * │                 │ Di Bawah   │ Memenuhi   │  Di Atas   │  Sangat    │ Istimewa │
 * │                 │ Ekspektasi │ Ekspektasi │ Ekspektasi │   Baik     │          │
 * ├─────────────────┼────────────┼────────────┼────────────┼────────────┼──────────┤
 * │ Di Bawah Eksp.  │ Sangat     │ Kurang     │ Kurang     │ Butuh      │ Butuh    │
 * │                 │ Kurang     │            │            │ Perbaikan  │ Perbaikan│
 * ├─────────────────┼────────────┼────────────┼────────────┼────────────┼──────────┤
 * │ Memenuhi Eksp.  │ Kurang     │ Baik       │ Baik       │ Baik       │ Sangat   │
 * │                 │            │            │            │            │ Baik     │
 * ├─────────────────┼────────────┼────────────┼────────────┼────────────┼──────────┤
 * │ Di Atas Eksp.   │ Butuh      │ Baik       │ Baik       │ Sangat     │ Sangat   │
 * │                 │ Perbaikan  │            │            │ Baik       │ Baik     │
 * ├─────────────────┼────────────┼────────────┼────────────┼────────────┼──────────┤
 * │ Sangat Baik     │ Butuh      │ Baik       │ Sangat     │ Sangat     │ Istimewa │
 * │                 │ Perbaikan  │            │ Baik       │ Baik       │          │
 * ├─────────────────┼────────────┼────────────┼────────────┼────────────┼──────────┤
 * │ Istimewa        │ Butuh      │ Sangat     │ Sangat     │ Istimewa   │ Istimewa │
 * │                 │ Perbaikan  │ Baik       │ Baik       │            │          │
 * └─────────────────┴────────────┴────────────┴────────────┴────────────┴──────────┘
 * 
 * Score Ranges:
 * - 1 = Di Bawah Ekspektasi
 * - 2 = Memenuhi Ekspektasi  
 * - 3 = Di Atas Ekspektasi
 * - 4 = Sangat Baik
 * - 5 = Istimewa
 *
 * @param int|float $hasil_kerja Work result score (1-5)
 * @param int|float $perilaku    Behavior score (1-5)
 * @return string Performance predicate
 */
function predikat_kinerja($hasil_kerja, $perilaku): string
{
    // Validate input - must be numeric
    if (!is_numeric($hasil_kerja) || !is_numeric($perilaku)) {
        return 'Invalid Input: Scores must be numeric';
    }

    // Round to nearest integer for matrix lookup
    $hk = (int) round($hasil_kerja);
    $p = (int) round($perilaku);

    // Validate range (1-5)
    if ($hk < 1 || $hk > 5 || $p < 1 || $p > 5) {
        return 'Invalid Input: Scores must be between 1 and 5';
    }

    // Performance predicate matrix
    // Row = hasil_kerja (1-5), Column = perilaku (1-5)
    $matrix = [
        1 => [1 => 'Sangat Kurang', 2 => 'Kurang', 3 => 'Kurang', 4 => 'Butuh Perbaikan', 5 => 'Butuh Perbaikan'],
        2 => [1 => 'Kurang', 2 => 'Baik', 3 => 'Baik', 4 => 'Baik', 5 => 'Sangat Baik'],
        3 => [1 => 'Butuh Perbaikan', 2 => 'Baik', 3 => 'Baik', 4 => 'Sangat Baik', 5 => 'Sangat Baik'],
        4 => [1 => 'Butuh Perbaikan', 2 => 'Baik', 3 => 'Sangat Baik', 4 => 'Sangat Baik', 5 => 'Istimewa'],
        5 => [1 => 'Butuh Perbaikan', 2 => 'Sangat Baik', 3 => 'Sangat Baik', 4 => 'Istimewa', 5 => 'Istimewa'],
    ];

    return $matrix[$hk][$p];
}

// ===========================================
// EXAMPLE USAGE
// ===========================================

// Example 1: Standard evaluation
$hasil = 4;
$perilaku = 5;
echo "Hasil Kerja: $hasil, Perilaku: $perilaku\n";
echo "Predikat: " . predikat_kinerja($hasil, $perilaku) . "\n\n";
// Output: Istimewa

// Example 2: Low performance
echo "Predikat (1,1): " . predikat_kinerja(1, 1) . "\n";
// Output: Sangat Kurang

// Example 3: Good performance
echo "Predikat (3,3): " . predikat_kinerja(3, 3) . "\n";
// Output: Baik

// Example 4: Invalid input handling
echo "Predikat (invalid): " . predikat_kinerja('abc', 3) . "\n";
// Output: Invalid Input: Scores must be numeric

echo "Predikat (out of range): " . predikat_kinerja(10, 3) . "\n";
// Output: Invalid Input: Scores must be between 1 and 5
