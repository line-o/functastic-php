<?php
// higher order function
// partial application oder currying
function add($a, $b) {
	if (isset($b)) { return $a + $b; }
	return create_function(array($c), "return $c +" . $a . ";");
}
print_r(add(1, 1));
$add1 = add(1);
print_r(call_user_func($add1, 1));
