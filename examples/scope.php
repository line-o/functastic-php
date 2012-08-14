<?php
function scope_provider () {
  $a = 10;
  function global_a() use ($a) {
    return $a++;
  }

  print('should return 11 = ' . global_a()); 
  print('should return 12 = ' . global_a()); 
  $a = 0;
  print('1 ? ' . global_a()); 
}

scope_provider();