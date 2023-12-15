<?php

$texto = 'Hoje o dia foi chato e como foi demorado, caramba!';
echo str_replace(['chato', 'caramba'], '****', $texto).PHP_EOL;
echo strtr($texto, 'chato', '@*@*#').PHP_EOL;
echo strtr($texto, ['chato' => '@*@*', 'caramba' => '***']).PHP_EOL;

$var = ['Hello' => 'Hi', 'Hi' => 'Hello'];
echo strtr('Hi all, I said Hello!', $var);
