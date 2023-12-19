<?php

$reader = fopen('text.txt', 'r');
while (!feof($reader)) {
    echo fgets($reader);
}
fclose($reader);
