<?php

require_once 'PerformanceHelper.php';

echo "=== Contoh Soal ===" . PHP_EOL;
echo "hasil_kerja = 'diatas ekspektasi', perilaku = 'diatas ekspektasi'" . PHP_EOL;
echo "Output: " . predikat_kinerja('diatas ekspektasi', 'diatas ekspektasi') . PHP_EOL;

echo PHP_EOL . "=== Test Semua Kombinasi ===" . PHP_EOL;

$hasil_kerja_values = [
    'diatas ekspektasi',
    'sesuai ekspektasi',
    'dibawah ekspektasi'
];

$perilaku_values = [
    'dibawah ekspektasi',
    'sesuai ekspektasi',
    'diatas ekspektasi'
];

foreach ($hasil_kerja_values as $hk) {
    foreach ($perilaku_values as $p) {
        echo "hasil_kerja: '{$hk}' | perilaku: '{$p}' => "
           . predikat_kinerja($hk, $p)
           . PHP_EOL;
    }
}