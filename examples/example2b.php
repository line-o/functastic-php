<?php
// higher order function
// partial application
// currying
function add() {
	$n = func_num_args();
	if ($n == 0) return;

	$a = func_get_arg(0);

	if ($n == 1) {
		$f = function($c) use ($a) {
			return $c + $a;
		};
		return $f;
	} 

	// otherwise add first two passed arguments
	$b = func_get_arg(1);
	return $a + $b;
}

echo  'add(1,1) = ' . add(1, 1) . PHP_EOL;

$add1 = add(1);
echo  '$add1 = add(1); $add1(1) = ' . $add1(1) . PHP_EOL;

echo  'add(1)(1) = FATAL' . PHP_EOL;
echo  '(add(1))(1) = FATAL' . PHP_EOL;

//
// MULTIPLY
//

function multiply($a, $b) {
	$result = 0;
	$add_b = add($b);
	for ($i = $a; $a--; ) {
		$result = $add_b($result);
	}
	return $result;
}

echo  'multiply(1, 1) = ' . multiply(1, 1) . PHP_EOL;

echo  'multiply(2, 3) = ' . multiply(2, 3) . PHP_EOL;

echo  'multiply(4, 5) = ' . multiply(4, 5) . PHP_EOL;
