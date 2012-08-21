<?php
//context provider
call_user_func(
    function ($ctx) {

        var_dump($ctx);
        //context dependent calculations...

    }, $argv
);