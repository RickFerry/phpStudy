<?php

class Filtro extends php_user_filter
{
    public $stream;

    public function onCreate(): bool
    {
        return $this->stream = fopen('php://temp', 'w+') !== false;
    }

    public function filter($in, $out, &$consumed, bool $closing): int
    {
        $saida = '';
        while ($bucket = stream_bucket_make_writeable($in)) {
            $linhas = explode('\n', $bucket->data);
            foreach ($linhas as $linha) {
                if (stripos($linha, 'morbi') !== false) {
                    $saida .= "$linha\n";
                }
            }
        }
        $bucketSaida = stream_bucket_new($this->stream, $saida);
        stream_bucket_append($out, $bucketSaida);
        return PSFS_PASS_ON;
    }
}
