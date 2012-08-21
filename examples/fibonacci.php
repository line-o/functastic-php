#!/usr/bin/php
<?php

include('../lib/ycombinator.php');
include('../lib/out.php');

/**
 * The functional that returns
 * the fixed point Fibonacci function
 * @param $g
 * @return callable
 */
$fibonacciFunctional = function ($g) {
    return function ($n) use ($g) {
        if ($n == 0 || $n == 1) {
            return $n;
        }
        return $g($n - 1) + $g($n - 2);
    };
};

/**
 * A different approach to calculate the Fibonacci number.
 * Seems to be broken, though.
 * source: http://www.zacharyfox.com/blog/fibonacci-project/fibonacci-in-php
 * @param $n
 * @return int
 */
$forfib = function ($n) {
    $a = 0;
    $b = 1;
    for ($i = 0; $i < $n; $i++) {
        $sum = $a + $b;
        $a = $b;
        $b = $sum;
    }
    return $sum;
};

/**
 * This may be bad, ugly and what not, but it is fast as hell.
 * See for yourself.
 * @param int     $n
 * @use   closure &$recFib
 * @return int
 */
$recFib = function ($n) use (&$recFib) {
    if ($n == 0 || $n == 1) {
        return $n;
    }
    return $recFib($n - 1) + $recFib($n - 2);
};


//available methods
$flavours = array(
    //retrieve the Fibonacci function using the non-memoizing Y-combinator
    'y-combinator' => Y($fibonacciFunctional),
    //retrieve the Fibonacci function using the memoizing Y-combinator
    'ymem-combinator' => Ymem2($fibonacciFunctional),
    'for-loop' => $forfib,
    'recursive' => $recFib
);

$flavours_short = array(
    'y' => 'y-combinator',
    'm' => 'ymem-combinator',
    'f' => 'for-loop',
    'r' => 'recursive'
);

$flags = array_map(function ($key) { return '--' . $key; }, array_keys($flavours));

$defaults = array(
    'num' => 0,
    'flavour' => 'recursive'
);

$error = function ($msg) use ($out, $flags) {
    $error_msg = "ERROR: $msg\nusage: php fibonacci [ " . join(" | ", $flags) . " ] <number>\n";
    $out($error_msg);
};

$sanitize_flag = function ($f) use ($error, $flavours, $flavours_short) {
    $normalized = '';
    if (strpos($f, '--') === 0) {
        $normalized = substr($f, 2);
    }
    else if (strpos($f, '-') === 0) {
        $normalized = $flavours_short[substr($f, 1)];
    }

    if (in_array($normalized, array_keys($flavours))) {
        return $normalized;
    }
    $error('unknown flavour: ' . $f);
};

$parse_in = function ($args) use ($error, $sanitize_flag, $defaults) {
    $is_valid_num = function ($n) {
        return (is_numeric($n) && $n >= 0);
    };

    $arglen = count($args);
    if ($arglen === 1) {
        $error('No arguments passed!');
    }
    if ($arglen === 2 && $is_valid_num($args[1])) {
        return array_merge(
            $defaults,
            array('num' => (int) $args[1])
        );
    }
    if ($arglen === 2) {
        $error('Provide a number to calculate!');
    }
    $flavour = $sanitize_flag($args[1]);
    if ($is_valid_num($args[2])) {
        return array(
            'flavour' => $flavour,
            'num' => (int)$args[2]
        );
    }
    $error('Ouch! Something went wrong');
};

$calculate = function ($params) use ($out, $flavours) {
    //measure execution time
    $time_start = microtime(true);
    $res = $flavours[$params['flavour']]($params['num']);
    $time_end = microtime(true);

    //post-processing
    $time = $time_end - $time_start;
    $rounded = round($time, 32);
    $out("Fibonacci{{$params['flavour']}}({$params['num']}) = {$res}\n - calculation took {$rounded} seconds\n");
};

$calculate($parse_in($argv));
