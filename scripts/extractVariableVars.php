<?php
$str   = file_get_contents($argv[1]);
$parts = explode(';', preg_replace('/(\/\/.*?\n|\s\n|\s{2,})/', '', $str));
$vars  = array();

// Extract vars
foreach ($parts as $part) {
    $varMeta = explode(':', $part);
    if (empty($varMeta[0]) || empty($varMeta[1])) {
        continue;
    }
    $vars[substr(trim($varMeta[0]), 1)] = trim($varMeta[1]);
}

// The longest key in the array.
$l       = max(array_map('strlen', array_keys($vars)));
$varsStr = '<?php'.PHP_EOL.PHP_EOL.'return array(' . PHP_EOL;

// Make array
foreach ($vars as $key => $value) {
    $value    = str_replace("'", "\'", $value);
    $spaces   = ($l+1) - strlen($key);
    $varsStr .= "    '$key'".str_repeat(' ', $spaces)."=> '$value',".PHP_EOL;
}

$varsStr .= ');';

file_put_contents($argv[2], $varsStr);

