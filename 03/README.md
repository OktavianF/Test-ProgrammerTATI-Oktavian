# Problem 3 — Performance Predicate Function

## Overview
A function to determine employee performance predicate based on two scores: **hasil kerja** (work results) and **perilaku** (behavior).

## Function Signature
```php
function predikat_kinerja($hasil_kerja, $perilaku): string
```

## Parameters
| Parameter | Type | Range | Description |
|-----------|------|-------|-------------|
| `$hasil_kerja` | int/float | 1-5 | Work performance score |
| `$perilaku` | int/float | 1-5 | Behavior score |

## Score Interpretation
| Score | Meaning |
|-------|---------|
| 1 | Di Bawah Ekspektasi |
| 2 | Memenuhi Ekspektasi |
| 3 | Di Atas Ekspektasi |
| 4 | Sangat Baik |
| 5 | Istimewa |

## Scoring Matrix
| Hasil Kerja ↓ / Perilaku → | 1 | 2 | 3 | 4 | 5 |
|----------------------------|---|---|---|---|---|
| **1** | Sangat Kurang | Kurang | Kurang | Butuh Perbaikan | Butuh Perbaikan |
| **2** | Kurang | Baik | Baik | Baik | Sangat Baik |
| **3** | Butuh Perbaikan | Baik | Baik | Sangat Baik | Sangat Baik |
| **4** | Butuh Perbaikan | Baik | Sangat Baik | Sangat Baik | Istimewa |
| **5** | Butuh Perbaikan | Sangat Baik | Sangat Baik | Istimewa | Istimewa |

## Usage Example
```php
require_once 'PerformanceHelper.php';

// Example calls
echo predikat_kinerja(4, 5);  // Output: Istimewa
echo predikat_kinerja(2, 2);  // Output: Baik
echo predikat_kinerja(1, 1);  // Output: Sangat Kurang
```

## Error Handling
- Returns `"Invalid Input: Scores must be numeric"` for non-numeric input
- Returns `"Invalid Input: Scores must be between 1 and 5"` for out-of-range values

## Run Example
```bash
php PerformanceHelper.php
```
