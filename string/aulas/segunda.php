<?php

$url = 'http://ferry.com.br';
if (str_starts_with($url, 'http')) {
    echo  'Starts with http';
} else {
    echo 'Does not start with http';
}
echo PHP_EOL;
if (str_ends_with($url, 'br')){
    echo  'Ends with br';
} else {
    echo 'Does not end with br';
}
