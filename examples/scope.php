<?php

class Scoper {
	function a () {
	  static $c = 10;

	  $inner = function () use ($c) {
	    return $c;
	  };
	  $c++;

	  print($inner() . PHP_EOL);
	}

	function b () {
	  static $c = 10;

	  $inner = function () use ($c) {
	    return $c++;
	  };

	  print($inner() . PHP_EOL);
	}

	function c ($f) {
	  static $c = 10;
	  print($f() . PHP_EOL);
	}

	function d ($f) {
	  static $c = 10;

	  $rf = function () use($c,$f) {
	  		return $f($c);
	  };
	  print($rf() . PHP_EOL);
	}

}

$s = new Scoper;

print("a:" . PHP_EOL);
$s::a();
$s::a();
$s::a();

print("b:" . PHP_EOL);
$s::b();
$s::b();
$s::b();

$c = 1;
$comp_func = function () use ($c) {
	$c++;
	return $c;
};

print("c:" . PHP_EOL);
$s::c($comp_func);
$s::c($comp_func);
$s::c($comp_func);


$lazy_func = function ($a) {
	$a++;
	return $a;
};

print("d:" . PHP_EOL);
$s::d($lazy_func);
$s::d($lazy_func);
$s::d($lazy_func);
//  $a = 0;
//  print('1 ? ' . global_a()); 
