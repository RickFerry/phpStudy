<?php

require_once 'src/Modelo/Conta/Conta.php';
require_once 'src/Modelo/Endereco.php';
require_once 'src/Modelo/Pessoa.php';
require_once 'src/Modelo/Conta/Titular.php';
require_once 'src/Modelo/Cpf.php';

use Alura\Banco\Modelo\Conta\Titular;
use Alura\Banco\Modelo\Endereco;
use Alura\Banco\Modelo\Cpf;
use Alura\Banco\Modelo\Conta\Conta;

$endereco = new Endereco('Rua 1','Numero 2','Bairro 3', 'Cidade 4');
$conta = new Conta(new Titular('Ferry', new Cpf('123.456.789-00'), $endereco));
$conta->depositar(1000);
$conta->sacar(500);
var_dump($conta);

$conta2 = new Conta(new Titular('Ricardo', new Cpf('103.456.780-01'), $endereco));
$conta2->depositar(400);

$conta->transferir(100, $conta2);

var_dump($conta2);
echo "O total de contas criadas foi: " . Conta::getTotalContas() . "\n";