<?php
//functions in functions
/**
//this parses but fails on first call
function sub_glob_func ($rng) {
	//functions are always global
	function sub ($a) {
		return $a < 23;
	}
	return array_filter($rng, sub);
}
*/

function return_smaller ($num, $arr) {
	//functions are always global
	$sub = function ($a) use ($num) {
		return $a < $num;
	};
	return array_filter($arr, $sub);
}

//echo sub_glob_func(range(10));
var_dump(return_smaller(23, range(1,100)));
