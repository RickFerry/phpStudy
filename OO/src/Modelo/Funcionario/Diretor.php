<?php

namespace Alura\Banco\Modelo\Funcionario;

class Diretor extends Funcionario implements Autenticavel
{
    public function getBonificacao(): float
    {
        return parent::getSalario() * 2;
    }

    public function podeAutenticar(string $senha): bool
    {
        return $senha === '123';
    }
}
