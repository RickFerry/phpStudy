<?php

$reader = fopen('text.txt', 'r');
echo fread($reader, filesize('text.txt'));
fclose($reader);
