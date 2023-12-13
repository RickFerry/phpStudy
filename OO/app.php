<?php

require_once 'autoload.php';

use Alura\Banco\Modelo\Conta\Conta;
use Alura\Banco\Modelo\Conta\ContaCorrente;
use Alura\Banco\Modelo\Conta\ContaPoupanca;
use Alura\Banco\Modelo\Conta\Titular;
use Alura\Banco\Modelo\Cpf;
use Alura\Banco\Modelo\Endereco;

$endereco = new Endereco('Rua 1', 'Numero 2', 'Bairro 3', 'Cidade 4');
$conta = new ContaCorrente(new Titular('Fernando', new Cpf('123.456.789-00'), $endereco));
$conta->depositar(1000);
$conta->sacar(100);
var_dump($conta);

$conta2 = new ContaPoupanca(new Titular('Fernando', new Cpf('123.456.789-00'), $endereco));
$conta2->depositar(1000);
$conta2->sacar(100);

$conta->transferir(100, $conta2);

var_dump($conta2);
echo "O total de contas criadas foi: " . Conta::getTotalContas() . "\n";