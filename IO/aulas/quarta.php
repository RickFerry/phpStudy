<?php

$resource = fopen('novo.txt', 'a+');
fwrite($resource, 'Testando a escrita em PHP.'.PHP_EOL);
file_put_contents('novo.txt', 'Testando a escrita em PHP.'.PHP_EOL, FILE_APPEND);
fclose($resource);
