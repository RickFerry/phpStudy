<?php

$str = '*-hoje é quinta-*';
echo trim($str, '-*');
echo PHP_EOL;
echo rtrim($str, '-*');
echo PHP_EOL;
echo ltrim($str, '-*');
