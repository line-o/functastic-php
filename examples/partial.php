<?php
/**
 * higher order functions and
 * partial application (currying)
 */

/**
 * add
 */
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
echo  '$add1 = add(1); $add1(1) = ' . $add1(1) . PHP_EOL; // returns 2

//echo  'add(1)(1) = FATAL' . PHP_EOL;
//echo  '(add(1))(1) = FATAL' . PHP_EOL;

/**
 * multiply
 */
function multiply($a, $b) {
	$result = 0;
	$add_b = add($b);

	// add $b $a times
	for ($i = $a; $a--; ) {
		$result = $add_b($result);
	}

	return $result;
}

echo  'multiply(1, 1) = ' . multiply(1, 1) . PHP_EOL;

echo  'multiply(2, 3) = ' . multiply(2, 3) . PHP_EOL;

echo  'multiply(4, 5) = ' . multiply(4, 5) . PHP_EOL;

/**
 * the recursive approach
 * thanks to @fwg for this idea...
 */
function mulrec($a, $b) {
	$result = 0;
	$add_b = add($b);

	//pass itself by reference to allow late binding
	//to decrease the counter variable $i makes it a for-loop again 
	$rec_add = function ($i, $result, $add_b) use (&$rec_add) {
		echo $result;
		$result = $add_b($result);
		if ($i) {
			return $rec_add(--$i, $result, $add_b);
		}
		return $result;
	};

	return $rec_add(--$a, $result, $add_b);
}

echo 'mulrec(1,2) = ' . mulrec(1,2) . PHP_EOL;
echo 'mulrec(2,3) = ' . mulrec(2,3) . PHP_EOL;
echo 'mulrec(4,5) = ' . mulrec(4,5) . PHP_EOL;

include '../lib/curry.php';

$add = function ($a, $b) {
    return $a + $b;
};

$p_add_two = curry($add, 2);

echo 'curry($add,2) => (2) = ' . $p_add_two(2);