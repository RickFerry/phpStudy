<?php

namespace Alura\Banco\Modelo\Funcionario;

class Desenvolvedor extends Funcionario
{
    public function promocao()
    {
        parent::recebeAumento(parent::getSalario() * 0.75);
    }

    public function getBonificacao(): float
    {
        return parent::getSalario() * 0.05;
    }
}
