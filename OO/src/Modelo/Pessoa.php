<?php

namespace Alura\Banco\Modelo;

use Exception;

abstract class Pessoa
{
    private string $nome;
    private Cpf $cpf;

    /**
     * @param string $nome
     * @param Cpf $cpf
     * @throws Exception
     */
    public function __construct(string $nome, Cpf $cpf)
    {
        $this->validaNome($nome);
        $this->nome = $nome;
        $this->cpf = $cpf;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getCpf(): Cpf
    {
        return $this->cpf;
    }

    /**
     * @throws Exception
     */
    public function validaNome(string $nome)
    {
        if (strlen($nome) < 5) {
            throw new Exception("O nome deve ter pelo menos 5 caracteres");
            exit();
        }
    }
}