![test](http://4.bp.blogspot.com/_6m1GwPz8e34/S6LaIgiBs0I/AAAAAAAAASw/66RPdKfgnfo/s200/functionalProgramming.png)
# Functional Programming
- (un)typed lambda calculus
- type theory
-- inference (Hindley-Milner)
-- intuitionistic 
- predicate logic
- mathematical proofs

## getting started

### Lambda Funktionen
````php
	$add = function ($a, $b) { return $a + $b; };
````

### Funktionen als Parameter

vorher:
````php
  function greaterThanZero($n) {
	return ($n > 0 ? 'true' : 'false');
  }
  print_r(array_map('greaterThanZero', array(0, 1)));
````

* neue globale Funktion
* mögliche Namenskollision

nachher:
````php
  $map_func = function ($n) {
	    return ($n > 0 ? 'true' : 'false');
  };
  print_r(array_map($map_func, array(0, 1)));
````

* anonyme (lambda) Funktion
* existiert nur im lokal Scope

### Scope?
````php
  function local_a () {
    $a = 0;
    return $a++;
  }
  local_a(); //returns 1
  local_a(); //returns 1
````

````php
  $a = 10;
  function global_a () use ($a) {
    return $a++;
  }

  global_a(); //returns 11
  global_a(); //returns 12
  $a = 0;
  global_a(); //returns 1
````

zurück zum Beispiel:
````php
  for($i=100;$i--;) {
	$map_func = function ($n) use ($i) {
      return ($n > $i ? 'true' : 'false');
	};
	print(count(array_filter($map_func, range(100))));
  }
````
woher kommt denn jetzt die _range_ Funktion

````php
function range($boundary_a, $boundary_b) {
  $range = array();
  if (!isset($boundary_b)) {
  	return range(0, $boundary_a);
  }
  for($c=$boundary_a;$c<$boundary_b;$c++) {
  	array_push($c, $range);
  }
  return $range;
}
````


### partial application

````php
function add ($a, $b) {
	if (is_null($b)) {
		return function ($c) use ($a) {
			return $a + $c;
		};
	}
	else {
		return $a + $b;
	}
}
````
*Finally landed in PHP 5.3 and 5.4*
