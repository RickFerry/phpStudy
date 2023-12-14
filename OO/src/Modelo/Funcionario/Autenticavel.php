<?php

namespace Alura\Banco\Modelo\Funcionario;

interface Autenticavel
{
    public function podeAutenticar(string $senha): bool;
}
