<?php

$resource = stream_context_create([
    'zip' => [
        'password' => '123'
    ]
]);

echo file_get_contents('zip://textos.zip#novo.txt', false, $resource);
