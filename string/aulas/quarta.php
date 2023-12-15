<?php

$email = 'ferry@gmail.com';
echo substr($email, 0, strpos($email, '@'));
echo PHP_EOL;
echo substr($email, strpos($email, '@') + 1);
