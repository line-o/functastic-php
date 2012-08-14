<?php

function greaterThanZero ($n) {	return $n > 0; }
print_r(array_map([0,1], 'greaterThanZero'));
