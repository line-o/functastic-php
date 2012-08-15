<?php
/*
  for($i=100;$i--;) {
	$map_func = function ($n) use ($i) {
      return ($n > $i ? 'true' : 'false');
	};
	print(count(array_filter($map_func, range(100))));
  }

print(array_reduce(range(10), function ($result, $item) {
		return 
	}, 
	array()
));
*/
function my_range() {
	$args = func_get_args();
	$argslen = count($args);

	if ($argslen === 0) return;

	$boundary_a = $args[0];

	if ($argslen === 1 && $boundary_a > 0) {
		return range(0, $boundary_a);
	}
	else if ($argslen === 1 && $boundary_a <= 0) {
		return range($boundary_a, 0);
	}

	//now get the second argument
	$boundary_b = $args[1];
	
	if ($boundary_b > $boundary_a) {
		return array_reverse(range($boundary_b, $boundary_a));
	}

	//ok, now we can start
	$range = array();
	for($c = $boundary_a; $c < $boundary_b; $c++) {
		array_push($c, $range);
	}
	return $range;
}


function sum($list) {
	$result = 0;
	foreach ($list as $item) {
		$result += $item;
	}
	return $result;
}
$amt = 100;
print(PHP_EOL . 'sum(my_range(' . $amt . ')) = ' . sum(my_range($amt)) . PHP_EOL . PHP_EOL);