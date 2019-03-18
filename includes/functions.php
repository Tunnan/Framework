<?php

// Debug a variable in a more readable way
function debug($var)
{
  $trace = debug_backtrace();
  $output = '<pre><p style="color:#CD3F37;">' . 
    $trace[0]['file'] . ', line ' . $trace[0]['line'] . '</p>' . 
    var_export($var, true) . '</pre>';
  
  echo "<div style='color:#333333;font-family:monospace;font-size:12px;font-weight:bold;border-bottom:1px #ccc solid;padding:10px 0;'>$output</div>";
}
