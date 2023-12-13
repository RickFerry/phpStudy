<?php

namespace Alura\Banco\Modelo\Conta;

class ContaCorrente extends Conta
{
    public function sacar(float $valor)
    {
        parent::sacar($valor);
    }

    function getPercentual(): float
    {
        return 0.05;
    }
}