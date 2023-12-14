<?php

namespace Alura\Banco\Modelo\Funcionario;

use Alura\Banco\Modelo\Cpf;
use Alura\Banco\Modelo\Pessoa;
use Exception;

abstract class Funcionario extends Pessoa
{
    private float $salario;

    /**
     * @param string $nome
     * @param Cpf $cpf
     * @param string $cargo
     * @param float $salario
     * @throws Exception
     */
    public function __construct(string $nome, Cpf $cpf, float $salario)
    {
        parent::__construct($nome, $cpf);
        $this->salario = $salario;
    }

    public function getSalario(): float
    {
        return $this->salario;
    }

    abstract public function getBonificacao(): float;

    public function recebeAumento(float $aumento)
    {
        if ($aumento<= 0) {
            echo 'Aumento deve ser ´positivo.';
            return;
        }
        $this->salario += $aumento;
    }
}
