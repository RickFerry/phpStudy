<?php

namespace Alura\Leilao\Tests\Model;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{

    public function testNaoDeveReceberLancesConsecultivosDoMesmoUsuario()
    {
        self::expectException(\DomainException::class);
        self::expectExceptionMessage('Usuário não pode propor 2 lances consecutivos');

        $leilao = new Leilao('Variante');
        $ana = new Usuario('Ana');
        $leilao->recebeLance(new Lance($ana, 1000.0));
        $leilao->recebeLance(new Lance($ana, 1500));
    }

    public function testNaoDeveReceberCincoLancesDoMesmoUsuario()
    {
        self::expectException(\DomainException::class);
        self::expectExceptionMessage('Usuário não pode propor mais de 5 lances por leilão');

        $leilao = new Leilao('Brasília Amarela');
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');

        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($maria, 1500));

        $leilao->recebeLance(new Lance($joao, 2000));
        $leilao->recebeLance(new Lance($maria, 2500));

        $leilao->recebeLance(new Lance($joao, 3000));
        $leilao->recebeLance(new Lance($maria, 3500));

        $leilao->recebeLance(new Lance($joao, 4000));
        $leilao->recebeLance(new Lance($maria, 4500));

        $leilao->recebeLance(new Lance($joao, 5000));
        $leilao->recebeLance(new Lance($maria, 5500));

        // deve ser ignorado
        $leilao->recebeLance(new Lance($joao, 6000));
    }

    /**
     * @dataProvider geraLances
     */
    public function testLeilaoNaoDeveReceberLances(int $qtdLances, Leilao $leilao, array $valores)
    {
        static::assertCount($qtdLances, $leilao->getLances());
        foreach ($valores as $i => $valorEsperado) {
            static::assertEquals($valorEsperado, $leilao->getLances()[$i]->getValor());
        }
    }

    public function geraLances()
    {
        $leilao2 = new Leilao('Variante');
        $ana = new Usuario('Ana');
        $joao = new Usuario('João');
        $leilao2->recebeLance(new Lance($ana, 2000));
        $leilao2->recebeLance(new Lance($joao, 2500));

        $leilao1 = new Leilao('Fusca 1972 0km');
        $ana = new Usuario('Ana');
        $leilao1->recebeLance(new Lance($ana, 3000));

        return [
            [2, $leilao2, [2000, 2500]],
            [1, $leilao1, [3000]],
        ];
    }
}
