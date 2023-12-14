<?php

namespace Alura\Banco\Modelo\Funcionario;

class Gerente extends Funcionario implements Autenticavel
{
    public function getBonificacao(): float
    {
        return parent::getSalario();
    }

    public function podeAutenticar(string $senha): bool
    {
        return $senha === '321';
    }
}
