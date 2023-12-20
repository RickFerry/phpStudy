<?php

$object = new SplFileObject('todos.csv');
while (!$object->eof()){
    $linha = $object->fgetcsv(';');
    //echo utf8_encode($linha[0].PHP_EOL);
    echo mb_convert_encoding($linha[1], 'UTF-8', 'UTF-8');
}
$time = new DateTime();
$time->setTimestamp($object->getCTime());
echo $time->format('d/m/Y H:i:s').PHP_EOL;
