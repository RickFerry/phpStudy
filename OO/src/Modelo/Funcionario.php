<?php

namespace Alura\Banco\Modelo;

use Exception;

require_once 'src/Pessoa.php';

class Funcionario extends Pessoa
{
    private string $cargo;

    /**
     * @param string $nome
     * @param Cpf $cpf
     * @param string $cargo
     * @throws Exception
     */
    public function __construct(string $nome, Cpf $cpf, string $cargo)
    {
        parent::__construct($nome, $cpf);
        $this->cargo = $cargo;
    }

    public function getCargo(): string
    {
        return $this->cargo;
    }
}