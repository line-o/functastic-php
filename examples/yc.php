<?php
include '../lib/ycombinator.php';

/**
 * Y(FunctionalFactorial) returns the fixed point function for factorial
 */
$factorial = Y(function ($fac) {
    return function ($n) use ($fac) {
        if ($n == 0) { return 1; }
        else { return $n * $fac($n - 1); }
    };
});
 
//echo assert(120 === $factorial(5));
var_dump($factorial(5));