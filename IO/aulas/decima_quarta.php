<?php

$directory = dir('.');
echo $directory->path.PHP_EOL;

while ($file = $directory->read()){
    echo $file.PHP_EOL;
}
