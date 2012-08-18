<?php

function b() {
	return 'or...';
}	


if (true) {
	function b() {
		return 'so true';
	}
}

echo b();