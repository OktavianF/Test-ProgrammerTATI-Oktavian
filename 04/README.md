# Problem 4 — HelloWorld Function

## Overview
A FizzBuzz-style function that outputs "hello", "world", or "helloworld" based on divisibility rules.

## Function Signature
```php
function helloworld(int $n): array
```

## Rules
| Condition | Output |
|-----------|--------|
| Divisible by 4 only | `"hello"` |
| Divisible by 5 only | `"world"` |
| Divisible by both 4 AND 5 | `"helloworld"` |
| Otherwise | The number itself |

## Parameters
| Parameter | Type | Description |
|-----------|------|-------------|
| `$n` | int | Upper limit (loops from 1 to n) |

## Return Value
Returns an **array** containing the results for each number from 1 to n.

## Usage Example
```php
require_once 'HelloWorldHelper.php';

// Get as array
$result = helloworld(20);
print_r($result);

// Get as string (alternative function)
echo helloworld_string(20, ', ');
```

## Expected Output for `helloworld(20)`
```
1, 2, 3, hello, world, 6, 7, hello, 9, world, 11, hello, 13, 14, world, hello, 17, 18, 19, helloworld
```

### Breakdown
| Number | Output | Reason |
|--------|--------|--------|
| 4 | hello | 4 ÷ 4 = 1 (divisible by 4) |
| 5 | world | 5 ÷ 5 = 1 (divisible by 5) |
| 8 | hello | 8 ÷ 4 = 2 (divisible by 4) |
| 10 | world | 10 ÷ 5 = 2 (divisible by 5) |
| 12 | hello | 12 ÷ 4 = 3 (divisible by 4) |
| 15 | world | 15 ÷ 5 = 3 (divisible by 5) |
| 16 | hello | 16 ÷ 4 = 4 (divisible by 4) |
| 20 | helloworld | 20 ÷ 4 = 5, 20 ÷ 5 = 4 (divisible by both) |

## Run Example
```bash
php HelloWorldHelper.php
```

## Design Decisions
1. **Returns array instead of echoing** — Makes the function testable and reusable
2. **Check "both" condition first** — Ensures correct priority (helloworld > hello/world)
3. **Uses descriptive boolean variables** — Improves readability (`$divisibleBy4` vs direct modulo check)
