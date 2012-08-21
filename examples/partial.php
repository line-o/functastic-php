<?php
/**
 * higher order functions and
 * partial application (currying)
 */

include '../lib/curry.php';
include '../lib/out.php';

/**
 * add function
 * returns higher order function if given only one parameter
 * @return void|int|closure
 */
$add = function () {
    $n = func_num_args();
    if ($n == 0) {
        return;
    }

    $a = func_get_arg(0);
    // return closure, if only one parameter was passed
    if ($n == 1) {
        return function($c) use ($a) {
            return $c + $a;
        };
    }

    // otherwise add first two passed arguments
    $b = func_get_arg(1);
    return $a + $b;
};

echo  'add(1,1) = ' . $add(1, 1) . PHP_EOL;

$add1 = $add(1);
echo  '$add1 = add(1); $add1(1) = ' . $add1(1) . PHP_EOL; // returns 2

/**
 * multiply
 */
$multiply = function ($a, $b) use ($add) {
    $result = 0;
    $add_b = $add($b);

    // add $b $a times
    for ($i = $a; $a--;) {
        $result = $add_b($result);
    }

    return $result;
};

echo  'multiply(1, 1) = ' . $multiply(1, 1) . PHP_EOL;
echo  'multiply(2, 3) = ' . $multiply(2, 3) . PHP_EOL;
echo  'multiply(4, 5) = ' . $multiply(4, 5) . PHP_EOL;

/**
 * Now for a more generalized approach
 * Yes, we can re-implement add this way.
 * @see lib/curry.php for implementation
 */
$add = function ($a, $b) {
    return $a + $b;
};
$add_two = curry($add, 2);
echo 'curry($add,2) => (2) = ' . $add_two(2);