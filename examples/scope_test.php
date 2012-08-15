<?php

$a = 1;

$global_ref_a = function() use (&$a) {
	echo 'R' . ++$a . PHP_EOL;
};

$global_a = function() use ($a) {
	echo ++$a . PHP_EOL;
};

$global_a(); //returns 2
$global_ref_a(); //returns 2
$global_a(); //returns 2

//NEW VALUE FOR $a
$a = 0;
$global_a(); //returns 1
$global_ref_a(); //returns 3
$global_a(); //returns 2
