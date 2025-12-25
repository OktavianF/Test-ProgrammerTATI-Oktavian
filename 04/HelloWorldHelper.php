<?php

/**
 * HelloWorld Helper
 * 
 * A classic FizzBuzz-style function that prints "hello", "world", or "helloworld"
 * based on divisibility rules.
 */

/**
 * Generate hello/world output based on divisibility rules.
 * 
 * Rules:
 * - Divisible by 4 only       → "hello"
 * - Divisible by 5 only       → "world"
 * - Divisible by both 4 AND 5 → "helloworld"
 * - Otherwise                 → the number itself
 *
 * @param int $n The upper limit (loop from 1 to n)
 * @return array Array of results
 */
function helloworld(int $n): array
{
    $result = [];

    for ($i = 1; $i <= $n; $i++) {
        $divisibleBy4 = ($i % 4 === 0);
        $divisibleBy5 = ($i % 5 === 0);

        if ($divisibleBy4 && $divisibleBy5) {
            $result[] = 'helloworld';
        } elseif ($divisibleBy4) {
            $result[] = 'hello';
        } elseif ($divisibleBy5) {
            $result[] = 'world';
        } else {
            $result[] = $i;
        }
    }

    return $result;
}

/**
 * Alternative: Return as formatted string instead of array.
 * 
 * @param int $n The upper limit
 * @param string $separator Separator between items (default: newline)
 * @return string Formatted output
 */
function helloworld_string(int $n, string $separator = "\n"): string
{
    return implode($separator, helloworld($n));
}

// ===========================================
// EXAMPLE USAGE
// ===========================================

echo "=== helloworld(20) as Array ===\n";
$output = helloworld(20);
print_r($output);

/*
Expected Output:
Array
(
    [0] => 1
    [1] => 2
    [2] => 3
    [3] => hello      (4 divisible by 4)
    [4] => world      (5 divisible by 5)
    [5] => 6
    [6] => 7
    [7] => hello      (8 divisible by 4)
    [8] => 9
    [9] => world      (10 divisible by 5)
    [10] => 11
    [11] => hello     (12 divisible by 4)
    [12] => 13
    [13] => 14
    [14] => world     (15 divisible by 5)
    [15] => hello     (16 divisible by 4)
    [16] => 17
    [17] => 18
    [18] => 19
    [19] => helloworld (20 divisible by both 4 and 5)
)
*/

echo "\n=== helloworld(20) as String ===\n";
echo helloworld_string(20, ', ');
// Output: 1, 2, 3, hello, world, 6, 7, hello, 9, world, 11, hello, 13, 14, world, hello, 17, 18, 19, helloworld

echo "\n\n=== Specific test for 20 (divisible by both 4 and 5) ===\n";
$test20 = helloworld(20);
echo "Value at position 20: " . $test20[19] . "\n";
// Output: helloworld
