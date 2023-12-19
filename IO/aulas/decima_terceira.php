<?php

$meus = file('text.txt');
$outros = file('novo.txt');

$csv = fopen('todos.csv', 'w');

foreach ($meus as $curso){
    $linha = [trim(utf8_decode($curso)), 'Sim'];
    fputcsv($csv, $linha, ';');
}

foreach ($outros as $curso){
    $linha = [trim(utf8_decode($curso)), 'Não'];
    fputcsv($csv, $linha, ';');
}

fclose($csv);
