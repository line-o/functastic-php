#Functional Programming in PHP

![test](http://4.bp.blogspot.com/_6m1GwPz8e34/S6LaIgiBs0I/AAAAAAAAASw/66RPdKfgnfo/s200/functionalProgramming.png)

##What is Functional Programming all about
- (un)typed lambda calculus
- type theory
-- type inference (Hindley-Milner)
-- intuitionistic types(?)
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
What they are good for?

###Functions as Parameters

before:
````php
    function do () {
        function greaterThanZero($n) {
            return ($n > 0 ? 'true' : 'false');
        }
        return array_map('greaterThanZero', array(0, 1))
    }
    print_r(do());
````

* introduces a new global function
* name collisions

after:
````php
    function do() {
        $map_func = function ($n) {
            return ($n > 0 ? 'true' : 'false');
        };
        return array_map($map_func, array(0, 1));
    }
    print_r(do());
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

###Using the reference
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


## Currying / Partial Application

specific example:
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
more generalized:
````php
    function partial()
    {
        $orig_args = func_get_args();
        $func = array_shift($orig_args);

        return function () use ($orig_args, $func) {
            $real_args = array_merge($orig_args, func_get_args());
            return call_user_func_array($func, $real_args);
        };
    }
````

##Immediate Function

Calling a closure immediately.

these won't work:
````php
    function (){ echo 'HI!' }();
    print(function (){ return 'HI!' });
````

this does:
````php
    call_user_func(function () {
        //code here gets immediately executed
    });
````

and by passing a parameter you can provide some context: (without the use keyword)
````php
    call_user_func(function ($context) {
        //code here knows its $context
    }, $ctx);
````

##Y-Combinator

Getting rid of recursion by rewriting functions.
The Y-Combinator takes a functional as its parameter and returns the fixed point function for that functional.

Mathematically spoken
  f = F(f) //f is the fixed point of F
  f = Y(F) //Y returns the fixed point of the functional F

````php
function Y($Functional) {
    return call_user_func(
        function ($x) use ($Functional) {
            return $Functional(
                function ($v) use ($x) {
                    return call_user_func(
                        call_user_func($x, $x), $v
                    );
                }
            );
        },
        function ($x) use ($Functional) {
            return $Functional(
                function ($v) use ($x) {
                    return call_user_func(
                        call_user_func($x, $x), $v
                    );
                }
            );
        }
    );
}
````

###memoizing Y-combinator

Is a special version of the above combinator function that caches the results of previous calls to the Functional with
the same set of parameters.

This should make calls to f linear.

My tests could not prove that.
The ugly self-reference was the fastest.

````php
$recFib = function ($n) use (&$recFib) {
    if ($n == 0 || $n == 1) {
        return $n;
    }
    return $recFib($n - 1) + $recFib($n - 2);
};
````


##Things I learned?

* I may be doing it wrong!
* Y-Combinators are slow in PHP
* Let's hear what @koredn has to say about it ![link]

##whoami

>Juri Leino
working @spot-media
