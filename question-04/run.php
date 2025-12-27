<?php

require_once 'HelloWorldHelper.php';

echo "=== Test Fungsi helloworld(\$n) ===" . PHP_EOL . PHP_EOL;

// Test cases dari soal
$testCases = [1, 2, 3, 4, 5, 6, 10, 15, 20, 25];

foreach ($testCases as $n) {
    echo "helloworld({$n}) => " . helloworld($n) . PHP_EOL;
}
