<?php
require 'Filtro.php';

$resource = fopen('text.txt', 'r');

stream_filter_register('work.find', Filtro::class);
stream_filter_append($resource, 'work.find');
//stream_filter_append($resource, 'string.toupper');

echo fread($resource, filesize('text.txt'));
