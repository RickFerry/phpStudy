<?php

function getEmail($nome)
{
    return <<<FIM
        Eu $nome, sou dev
        deste que comecei
        a estudar na escola
        do padre a alguns anos.
        FIM;
}

echo getEmail('João');

echo PHP_EOL;
echo PHP_EOL;

function getEmail_2($nome)
{
    return <<<'FIM'
        Eu $nome, sou dev
        deste que comecei
        a estudar na escola
        do padre a alguns anos.
        FIM;
}

echo getEmail_2('João');
