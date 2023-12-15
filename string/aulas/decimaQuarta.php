<?php

$telefones = ['11 983514029', '11 98351-4029', '(11) 98351 - 4029', '11983514029', '(11)98351-4029'];
foreach ($telefones as $telefone) {
    $regex = '/^\(([0-9]{2})\) (9?[0-9]{4} - [0-9]{4})$/';
    $validos = preg_match(
        $regex,
        $telefone,
        $matches
    );
    echo implode($matches).PHP_EOL.PHP_EOL;
    if ($validos) {
        echo 'Valido!'.PHP_EOL.PHP_EOL;
    } else {
        echo 'Invalido!'.PHP_EOL.PHP_EOL;
    }

    echo preg_replace($regex, '(XX) \2', $telefone).PHP_EOL.PHP_EOL;
}
