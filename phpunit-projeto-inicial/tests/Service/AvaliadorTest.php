<?php

namespace Service;

use DomainException;
use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use PHPUnit\Framework\TestCase;
use Alura\Leilao\Service\Avaliador;

class AvaliadorTest extends TestCase
{
    private Avaliador $avaliador;

    protected function setUp(): void
    {
        $this->avaliador = new Avaliador();
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testDevePegarOMaiorLance(Leilao $leilao)
    {
        $this->avaliador->avalia($leilao);

        $maiorValor = $this->avaliador->getMaiorValor();
        self::assertEquals(6000, $maiorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testDevePegarOMenorLance(Leilao $leilao)
    {
        $this->avaliador->avalia($leilao);

        $menorValor = $this->avaliador->getMenorValor();
        self::assertEquals(3000, $menorValor);
    }

    /**
     * @dataProvider leilaoEmOrdemCrescente
     * @dataProvider leilaoEmOrdemDecrescente
     * @dataProvider leilaoEmOrdemAleatoria
     */
    public function testDevePegarOsTresMaioresLances(Leilao $leilao)
    {
        $this->avaliador->avalia($leilao);

        $maioresLances = $this->avaliador->getMaioresLances();
        self::assertCount(3, $maioresLances);
        self::assertEquals(6000, $maioresLances[0]->getValor());
        self::assertEquals(5000, $maioresLances[1]->getValor());
        self::assertEquals(4000, $maioresLances[2]->getValor());
    }

    public function testLeilaoVazioNaoPodeSerAvaliado()
    {
        self::expectException(\DomainException::class);
        self::expectExceptionMessage('Não é possível avaliar leilão vazio');

        $leilao = new Leilao('Fiat 147 0km');
        $this->avaliador->avalia($leilao);

    }

    public function testLeilaoFinalizadoNaoPodeSerAvaliado()
    {
        self::expectException(\DomainException::class);
        self::expectExceptionMessage('Leilão já finalizado');
        
        $leilao = new Leilao('Fiat 147 0km');
        $leilao->recebeLance(new Lance(new Usuario('João'), 2000));
        $leilao->finaliza();
        
        $this->avaliador->avalia($leilao);
    }

    public static function leilaoEmOrdemCrescente(): array
    {
        $leilao = new Leilao('Fiat 147 0km');

        $joao = new Usuario('João');
        $maria = new Usuario('Maria');
        $ana = new Usuario('Ana');
        $jorge = new Usuario('Jorge');

        $leilao->recebeLance(new Lance($maria, 3000));
        $leilao->recebeLance(new Lance($joao, 4000));
        $leilao->recebeLance(new Lance($ana, 5000));
        $leilao->recebeLance(new Lance($jorge, 6000));

        return [
            [$leilao]
        ];
    }

    public static function leilaoEmOrdemDecrescente(): array
    {
        $leilao = new Leilao('Fiat 147 0km');

        $joao = new Usuario('João');
        $maria = new Usuario('Maria');
        $ana = new Usuario('Ana');
        $jorge = new Usuario('Jorge');

        $leilao->recebeLance(new Lance($jorge, 6000));
        $leilao->recebeLance(new Lance($ana, 5000));
        $leilao->recebeLance(new Lance($joao, 4000));
        $leilao->recebeLance(new Lance($maria, 3000));

        return [
            [$leilao]
        ];
    }

    public static function leilaoEmOrdemAleatoria(): array
    {
        $leilao = new Leilao('Fiat 147 0km');

        $joao = new Usuario('João');
        $maria = new Usuario('Maria');
        $ana = new Usuario('Ana');
        $jorge = new Usuario('Jorge');

        $leilao->recebeLance(new Lance($ana, 5000));
        $leilao->recebeLance(new Lance($maria, 3000));
        $leilao->recebeLance(new Lance($jorge, 6000));
        $leilao->recebeLance(new Lance($joao, 4000));

        return [
            [$leilao]
        ];
    }
}