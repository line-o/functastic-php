<?php
function greaterThanZero($n) {
	return ($n > 0 ? 'true' : 'false');
}
$numbers = array(0, 1);
print_r(array_map('greaterThanZero', $numbers));
