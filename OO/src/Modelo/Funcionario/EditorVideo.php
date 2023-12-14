<?php

namespace Alura\Banco\Modelo\Funcionario;

class EditorVideo extends Funcionario
{
    public function getBonificacao(): float
    {
        return 600;
    }
}