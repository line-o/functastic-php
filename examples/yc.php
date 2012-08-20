<?php
/**
 * Working Y-combinator in PHP!
 */
function Y($f) {
    return call_user_func(
        function ($x) use ($f) {
            return $f(function ($v) use ($x) {
                    return call_user_func(
                        call_user_func($x, $x), $v);
                });
        },
        function ($x) use ($f) {
            return $f(function ($v) use ($x) {
                    return call_user_func(
                        call_user_func($x, $x), $v);
                });
        }
    );
}

$factorial = Y(function ($fac) {
    return function ($n) use ($fac) {
        if ($n == 0) { return 1; }
        else { return $n * $fac($n - 1); }
    };
});
 
//echo assert(120 === $factorial(5));
var_dump($factorial(5));