<?php

namespace Alura\Banco\Modelo\Conta;

abstract class Conta
{
    private Titular $titular;
    private float $saldo;
    private static $totalContas;

    /**
     * @param Titular $titular
     */
    public function __construct(Titular $titular)
    {
        $this->titular = $titular;
        $this->saldo = 0;
        self::$totalContas++;
    }

    public function depositar(float $valor)
    {
        if ($valor < 0) {
            echo "Valor negativo";
            return;
        }
        $this->saldo += $valor;
    }

    public function transferir(float $valor, Conta $conta)
    {
        if ($valor > $this->saldo) {
            echo "Saldo insuficiente";
            return;
        }
        $this->sacar($valor);
        $conta->depositar($valor);
    }

    public function sacar(float $valor)
    {
        $tarifa = $valor * $this->getPercentual();
        $valor += $tarifa;
        if ($valor > $this->saldo) {
            echo "Saldo insuficiente";
            return;
        }
        $this->saldo -= $valor;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }

    /**
     * @return mixed
     */
    public static function getTotalContas()
    {
        return self::$totalContas;
    }

    abstract function getPercentual(): float;
}