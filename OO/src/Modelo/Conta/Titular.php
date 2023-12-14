<?php

namespace Alura\Banco\Modelo\Conta;

use Alura\Banco\Modelo\Funcionario\Autenticavel;
use Alura\Banco\Modelo\Pessoa;
use Alura\Banco\Modelo\Cpf;
use Alura\Banco\Modelo\Endereco;
use Exception;

class Titular extends Pessoa implements Autenticavel
{
    private string $nome;
    private Cpf $cpf;
    private Endereco $endereco;

    /**
     * @param string $nome
     * @param Cpf $cpf
     * @param Endereco $endereco
     * @throws Exception
     */
    public function __construct(string $nome, Cpf $cpf, Endereco $endereco)
    {
        parent::__construct($nome, $cpf);
        $this->endereco = $endereco;
    }

    public function getEndereco(): Endereco
    {
        return $this->endereco;
    }

    public function setEndereco(Endereco $endereco): void
    {
        $this->endereco = $endereco;
    }

    public function podeAutenticar(string $senha): bool
    {
        return $senha === '999';
    }
}