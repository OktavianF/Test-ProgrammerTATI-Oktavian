<?php

declare(strict_types=1);

/**
 * Performance Helper
 * 
 * Menentukan predikat kinerja periodik pegawai berdasarkan 
 * hasil kerja dan perilaku.
 */

/**
 * @param string $hasil_kerja  Nilai hasil kerja pegawai
 * @param string $perilaku     Nilai perilaku pegawai
 * @return string Predikat kinerja pegawai
 */
function predikat_kinerja(string $hasil_kerja, string $perilaku): string
{
    // Normalize input: lowercase dan trim
    $hasil_kerja = strtolower(trim($hasil_kerja));
    $perilaku = strtolower(trim($perilaku));

    // Definisi matriks predikat kinerja
    // Format: [hasil_kerja][perilaku] => predikat
    $matrix = [
        'diatas ekspektasi' => [
            'dibawah ekspektasi' => 'Kurang/misconduct',
            'sesuai ekspektasi'  => 'Baik',
            'diatas ekspektasi'  => 'Sangat Baik',
        ],
        'sesuai ekspektasi' => [
            'dibawah ekspektasi' => 'Kurang/misconduct',
            'sesuai ekspektasi'  => 'Baik',
            'diatas ekspektasi'  => 'Baik',
        ],
        'dibawah ekspektasi' => [
            'dibawah ekspektasi' => 'Sangat Kurang',
            'sesuai ekspektasi'  => 'Butuh perbaikan',
            'diatas ekspektasi'  => 'Butuh perbaikan',
        ],
    ];

    // Validasi input hasil_kerja
    if (!isset($matrix[$hasil_kerja])) {
        return 'Input hasil_kerja tidak valid';
    }

    // Validasi input perilaku
    if (!isset($matrix[$hasil_kerja][$perilaku])) {
        return 'Input perilaku tidak valid';
    }

    return $matrix[$hasil_kerja][$perilaku];
}
