<?php

$object = new SplFileObject('todos.csv');
while (!$object->eof()){
    $linha = $object->fgetcsv(';');
    echo utf8_encode($linha[0].PHP_EOL);
}
$time = new DateTime();
$time->setTimestamp($object->getCTime());
echo $time->format('d/m/Y H:i:s').PHP_EOL;
