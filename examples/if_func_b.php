<?php

//this may work
$sub = function () {
    return 'or...';
};
$before = NULL;

if (isset($argv[1])) {
    $before = $sub;
    //changing not redeclaring $sub
    //building a call chain here
    $sub = function () use ($before) {
        return $before() . 'so true';
    };
}

var_dump($before);
var_dump($sub);

var_dump($sub());
