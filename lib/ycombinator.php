<?php
/**
 * standard, non-memoizing Y-Combinator
 * @param closure $Functional
 * @return closure fixed point function
 */
function Y($Functional) {
    return call_user_func(
        function ($x) use ($Functional) {
            return $Functional(
                function ($v) use ($x) {
                    return call_user_func(
                        call_user_func($x, $x), $v
                    );
                }
            );
        },
        function ($x) use ($Functional) {
            return $Functional(
                function ($v) use ($x) {
                    return call_user_func(
                        call_user_func($x, $x), $v
                    );
                }
            );
        }
    );
}

/**
 * Memoizing Y-Combinator,
 * Parameters are a functional and an (optional) cache of answers
 *
 * It returns the fixed point of the functional
 * that caches intermediate results.
 */
function Ymem($F, $cache = NULL) {
    if (!$cache) {
        $cache = array();
    } // Create a new $cache.
    return function($arg) use ($F, &$cache) {
        if (isset($cache[$arg])) {
            return $cache[$arg];
        } // Answer in $cache.
        $answer = call_user_func(
            call_user_func(
                $F, function($n) use ($F, &$cache) {
                    return call_user_func(Ymem($F, $cache), $n);
                }
            ),
            $arg
        ); // Compute the answer.
        $cache[$arg] = $answer; // Cache the answer.
        return $answer;
    };
}

/**
 * Test if passing the cache by reference makes
 * Memoizing Y-Combinator what it should be
 * Parameters are a functional and an (optional) cache of answers
 *
 * It returns the fixed point of the functional
 * that caches intermediate results.
 */
function Ymem2($F, $cache = NULL) {
    if (!$cache) {
        $cache = array();
    } // Create a new $cache.
    return function($arg) use ($F, &$cache) {
        if (isset($cache[$arg])) {
            return $cache[$arg];
        } // Answer in $cache.
        $answer = call_user_func(
            call_user_func(
                $F, function($n) use ($F, &$cache) {
                    return call_user_func(Ymem($F, $cache), $n);
                }
            ),
            $arg
        ); // Compute the answer.
        $cache[$arg] = $answer; // Cache the answer.
        return $answer;
    };
}
