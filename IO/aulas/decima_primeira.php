<?php

$resource = stream_context_create([
    'http' => [
        'method' => 'POST',
        'header' => "X-From: PHP\r\n" .
            "Content-Type: text/plain\r\n",
        'content' => 'some data'
    ]
]);
echo file_get_contents('http://httpbin.org/post', false, $resource);
