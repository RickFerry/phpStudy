<?php

require_once 'autoload.php';

use Alura\Banco\Modelo\Conta\Conta;
use Alura\Banco\Modelo\Conta\ContaCorrente;
use Alura\Banco\Modelo\Conta\ContaPoupanca;
use Alura\Banco\Modelo\Conta\Titular;
use Alura\Banco\Modelo\Cpf;
use Alura\Banco\Modelo\Endereco;
use Alura\Banco\Modelo\Funcionario\Desenvolvedor;
use Alura\Banco\Modelo\Funcionario\Diretor;
use Alura\Banco\Modelo\Funcionario\Gerente;
use Alura\Banco\Service\Autenticador;
use Alura\Banco\Service\ControladorDeBonificacoes;

$endereco = new Endereco('Rua 1', 'Numero 2', 'Bairro 3', 'Cidade 4');
echo $endereco->bairro . PHP_EOL;
echo $endereco . PHP_EOL;
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

$gerente = new Gerente('Fulano', new Cpf('123.321.999-00'), 3000);
$diretor = new Diretor('Cicrano', new Cpf('123.321.999-01'), 2000);
$dev = new Desenvolvedor('Fulano', new Cpf('023.321.999-00'), 3000);


$ctrl = new ControladorDeBonificacoes();
$ctrl->getBonificacaoDe($gerente);
$ctrl->getBonificacaoDe($diretor);
$ctrl->getBonificacaoDe($dev);
echo $ctrl->getTotalBonificacoes();

$security = new Autenticador();
$security->login($diretor, '123');
$security->login($gerente, '321');

echo PHP_EOL. $dev->nome;
