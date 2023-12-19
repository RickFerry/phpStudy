<?php
fwrite(STDOUT, "Hello world\n");
fwrite(STDERR, "Hello world\n");

$resource = fopen('zip://textos.zip#novo.txt', 'r');
stream_copy_to_stream($resource, STDERR);
