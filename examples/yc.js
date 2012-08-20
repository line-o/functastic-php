function Y(f) {
    return (
        (function (x) {
            return f(function (v) { 
                return x(x)(v); 
            }); 
        })

        (function (x) {
            return f(function (v) {
                return x(x)(v);
            });
        })

    );
}

var factorial = Y(function (fac) {
    return function (n) {
        if (n == 0) { return 1; }
        else { return n * fac(n - 1); }
    };
});
 
console.log(factorial(5));