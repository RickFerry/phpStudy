<?php

$nome = 'Ricardo Ferreira Martins';
$list = explode(' ', $nome);
echo var_dump($list);
echo PHP_EOL;
$list = explode(' ', $nome, 2);
echo var_dump($list);
