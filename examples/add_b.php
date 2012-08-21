<?php
// higher order function
// partial application
// currying
function add() {
    $n = func_num_args();
    if ($n == 0) {
        return;
    }

    $a = func_get_arg(0);
    if ($n == 1) {
        return create_function('$c', 'return $c +' . $a . ';');
    }

    // otherwise add first two passed arguments
    $b = func_get_arg(1);
    return $a + $b;
}

echo  'add(1,1) = ';
print_r(add(1, 1));
echo PHP_EOL;
$add1 = add(1);
echo  '$add1(1) = ';
print_r($add1(1));
echo PHP_EOL;
