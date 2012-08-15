<?php

//function () { return 'hello world'; }()
//function () { return 'hello world'; }();
//print( function () { return 'hello world'; }() );

$im = function () { print 'hello world'; };
$im();

$f = function () { return 'hello world'; };
print( $f() );


echo call_user_func(function () { return 'hello world'; });

//closest to immediate function as you can get
call_user_func(function () {
	print 'hello world'; 
});

call_user_func(function () {
	//closest to immediate function as you can get
});