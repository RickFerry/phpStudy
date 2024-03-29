<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\Service\Avaliador;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    /** @var Avaliador */
    private Avaliador $avaliador;

    protected function setUp(): void
    {
        $this->avaliador = new Avaliador();
    }

    /**
     * @dataProvider leilaoComLancesEmOrdemAleatoria
     * @dataProvider leilaoComLancesEmOrdemDecrescente
     * @dataProvider leilaoComLancesEmOrdemCrescente
     */
    public function testAvaliadorDeveAcharMaiorValor(Leilao $leilao)
    {
        $this->avaliador->avalia($leilao);

        self::assertEquals(2000, $this->avaliador->getMaiorValor());
    }

    /**
     * @dataProvider leilaoComLancesEmOrdemAleatoria
     * @dataProvider leilaoComLancesEmOrdemDecrescente
     * @dataProvider leilaoComLancesEmOrdemCrescente
     */
    public function testAvaliadorDeveAcharMenorValor(Leilao $leilao)
    {
        $this->avaliador->avalia($leilao);

        self::assertEquals(1000, $this->avaliador->getMenorValor());
    }

    /**
     * @dataProvider leilaoComLancesEmOrdemAleatoria
     * @dataProvider leilaoComLancesEmOrdemDecrescente
     * @dataProvider leilaoComLancesEmOrdemCrescente
     */
    public function testAvaliadorDeveOrdenarOs3Lances(Leilao $leilao)
    {
        $this->avaliador->avalia($leilao);

        $lances = $this->avaliador->getTresMaioresLances();

        self::assertCount(3, $lances);
        self::assertEquals(2000, $lances[0]->getValor());
        self::assertEquals(1500, $lances[1]->getValor());
        self::assertEquals(1000, $lances[2]->getValor());
    }

    public function testAvaliadorDeveRetornarOsMaioresLancesDisponiveis()
    {
        $leilao = new Leilao('Fiat 147 0KM');

        $leilao->recebeLance(new Lance(new Usuario('João'), 1000));
        $leilao->recebeLance(new Lance(new Usuario('Maria'), 1500));

        $this->avaliador->avalia($leilao);

        self::assertCount(2, $this->avaliador->getTresMaioresLances());
    }

    public static function leilaoComLancesEmOrdemCrescente(): array
    {
        $leilao = new Leilao('Fiat 147 0KM');
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($joao, 1000));
        $leilao->recebeLance(new Lance($maria, 1500));
        $leilao->recebeLance(new Lance($ana, 2000));

        return [
            [$leilao]
        ];
    }

    public static function leilaoComLancesEmOrdemDecrescente(): array
    {
        $leilao = new Leilao('Fiat 147 0KM');
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($ana, 2000));
        $leilao->recebeLance(new Lance($maria, 1500));
        $leilao->recebeLance(new Lance($joao, 1000));

        return [
            [$leilao]
        ];
    }

    public static function leilaoComLancesEmOrdemAleatoria(): array
    {
        $leilao = new Leilao('Fiat 147 0KM');
        $joao = new Usuario('João');
        $maria = new Usuario('Maria');
        $ana = new Usuario('Ana');

        $leilao->recebeLance(new Lance($maria, 1500));
        $leilao->recebeLance(new Lance($ana, 2000));
        $leilao->recebeLance(new Lance($joao, 1000));

        return [
            [$leilao]
        ];
    }
}
