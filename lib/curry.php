<?php
/**
 * Generalized function for partial application
 * also known as currying
 * @return closure
 */
function curry() {
    $orig_args = func_get_args();
    $func = array_shift($orig_args);
    //the closure with predefined arguments
    return function () use ($orig_args, $func) {
        $real_args = array_merge($orig_args, func_get_args());
        return call_user_func_array($func, $real_args);
    };
}
