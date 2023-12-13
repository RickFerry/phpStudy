<?php

spl_autoload_register(function (string $allPath) {
    $path = str_replace('Alura\\Banco', 'src', $allPath);
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $path);
    $path .= '.php';

    if (file_exists($path))
        require_once $path;
});