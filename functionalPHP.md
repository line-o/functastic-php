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
  $local_a = function () {
    $a = 0;
    echo $a++;
  }
  $local_a(); //returns 1
  $local_a(); //returns 1
````

````php
  $a = 1;
  $global_a = function() use ($a) {
    return ++$a;
  };

  $global_a(); //returns 2
  $global_a(); //returns 2
  $a = 0;
  $global_a(); //returns 2
````

###(Don't) Use the reference, Luke!
````php
  $a = 1;
  $global_a = function() use (&$a) {
    return ++$a;
  };

  $global_a(); //returns 2
  $global_a(); //returns 3
  $a = 0;
  $global_a(); //returns 1
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
*woher kommt denn jetzt die _range_ Funktion her...*


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
Etwas genereller:
````php
function partial() {
	$orig_args = func_get_args();
	$func = array_shift($orig_args);
	return function () use ($orig_args, $func) {
		$real_args = array_merge($orig_args, func_get_args());
		return call_user_func_array($func, $real_args);
	};
}
````

##Ich will es gleich

Immediate Function
````php
function (){ echo 'HI!' }();
print(function (){ return 'HI!' });
````

````php
call_user_func(function () {
	//code gets immediately executed
});
````

##Ich will es gleich

````php
````

*And all this _finally_ landed in PHP 5.3 and 5.4*
