<?php

// redeclaring functions
function b() {
    return 'or...';
}


if (false) {
    /* would throw a fatal error
    function b() {
        return 'so true';
    }
    */
}

echo b();