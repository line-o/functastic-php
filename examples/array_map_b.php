<?php
print_r(
	array_map(
		function ($n) {
			return ($n > 0 ? 'true' : 'false');
		},
		array(0, 1)
	)
);