![test](http://4.bp.blogspot.com/_6m1GwPz8e34/S6LaIgiBs0I/AAAAAAAAASw/66RPdKfgnfo/s200/functionalProgramming.png)

##whoami

>Juri Leino 
@spot-media


##Functional Programming
- (un)typed lambda calculus
- type theory
-- inference (Hindley-Milner)
-- intuitionistic 
- predicate logic
- mathematical proofs

* Don't *really* know what all this is?

* Me neither, but we may find out.

##the Idea behind it

* no side effects 
* no state

## Lambda functions
````php
	$add = function ($a, $b) { return $a + $b; };
````

###Functions as Parameters

before:
````php
  function greaterThanZero($n) {
	return ($n > 0 ? 'true' : 'false');
  }
  print_r(array_map('greaterThanZero', array(0, 1)));
````

* introduces a new global function
* name collisions

after:
````php
  $map_func = function ($n) {
	    return ($n > 0 ? 'true' : 'false');
  };
  print_r(array_map($map_func, array(0, 1)));
````

* anonymous (lambda) function
* exists only in local scope

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

back to our example:
````php
	$rng = range(0, 100);
  
  for($i=100;$i--;)
  {
    $map_func = function ($n) use ($i) { return ($n > $i) };
    print("#<$i: " . count(array_filter($map_func, $rng)) . PHP_EOL);
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

##Immediate Function

````php
function (){ echo 'HI!' }();
print(function (){ return 'HI!' });
````

````php
call_user_func(function () {
	//code gets immediately executed
});
````

##Headline

````php
````

##Things I learned?

* I'm doing it wrong!
* Let's hear what Kore has to say about it

