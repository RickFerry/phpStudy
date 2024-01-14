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
        $leilao = new Leilao('Variante');
        $ana = new Usuario('Ana');
        $leilao->recebeLance(new Lance($ana, 1000.0));
        $leilao->recebeLance(new Lance($ana, 1500));

        self::assertCount(1, $leilao->getLances());
        self::assertEquals(1000, $leilao->getLances()[0]->getValor());
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
