<?php

namespace Alura\Banco\Service;

use Alura\Banco\Modelo\Funcionario\Autenticavel;

class Autenticador
{
    public function login(Autenticavel $autenticavel, string $senha): void
    {
        if ($autenticavel->podeAutenticar($senha)) {
            echo PHP_EOL.'Entrando...';
        } else {
            echo PHP_EOL.'Senha inválida';
        }
    }
}
