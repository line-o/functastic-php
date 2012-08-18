<?php

$a = 1;

$global_ref_a = function() use (&$a) {
	return ++$a . PHP_EOL;
};

$global_a = function() use ($a) {
	return ++$a . PHP_EOL;
};

$global_over_a = function() use ($a) {
	$a = 'foo';
	return $a;
};

$global_over_a = function() use (&$a) {
	$a = 'foo';
//	return $a;
};

function test($func, $val) {
	$return = $func();
	echo (assert($return, $val) ? 'OK' : 'FAIL, instead of ' . $val . ' you got ' . $return);
}

test($global_a, 2); //returns 2
test($global_ref_a, 2); //returns 2
test($global_a, 2); //returns 2

//NEW VALUE FOR $a
$a = 0;
test($global_a,1); //returns 1
test($global_ref_a, 3); //returns 3
test($global_a, 2); //returns 2

test($global_over_a, 'foo'); //returns 'foo'
	