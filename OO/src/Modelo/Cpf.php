<?php

namespace Alura\Banco\Modelo;
class Cpf
{
    private string $numero;

    /**
     * @param string $numero
     */
    public function __construct(string $numero)
    {
        $numero = filter_var($numero, FILTER_VALIDATE_REGEXP, [
            'options' => ['regexp' => '/^\d{3}\.\d{3}.\d{3}-\d{2}$/']
        ]);
        if ($numero === false) {
            echo "CPF inválido!";
            exit();
        }
        $this->numero = $numero;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }
}