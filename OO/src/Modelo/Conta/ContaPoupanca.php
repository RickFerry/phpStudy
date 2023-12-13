<?php

namespace Alura\Banco\Modelo\Conta;

class ContaPoupanca extends Conta
{
    public function sacar(float $valor)
    {
        parent::sacar($valor);
    }

    function getPercentual(): float
    {
        return 0.03;
    }
}