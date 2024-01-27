<?php

namespace Alura\Leilao\Tests\Domain;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Dao\Leilao as LeilaoDao;
use Alura\Leilao\Model\Usuario;
use DateTimeImmutable;
use DomainException;
use Exception;
use PHPUnit\Framework\TestCase;

class LeilaoTest extends TestCase
{
//    private $leilaoDao;
//
//    protected function setUp(): void
//    {
//        //$this->leilaoDao = LeilaoDao::inFile();
//        $this->leilaoDao = LeilaoDao::inMemory();
//    }

    public function testProporLanceEmLeilaoFinalizadoDeveLancarExcecao()
    {
        self::expectException(DomainException::class);
        self::expectExceptionMessage('Este leilão já está finalizado');

        $leilao = new Leilao('Fiat 147 0KM');
        $leilao->finaliza();

        $leilao->recebeLance(new Lance(new Usuario(''), 1000));
    }

    /**
     * @param int $qtdEsperado
     * @param Lance[] $lances
     * @dataProvider dadosParaProporLances
     */
    public function testProporLancesEmLeilaoDeveFuncionar(int $qtdEsperado, array $lances)
    {
        $leilao = new Leilao('Fiat 147 0KM');
        foreach ($lances as $lance) {
            $leilao->recebeLance($lance);
        }

        self::assertCount($qtdEsperado, $leilao->getLances());
    }

    public function testMesmoUsuarioNaoPodeProporDoisLancesSeguidos()
    {
        $this->expectException(DomainException::class);
        $this->expectExceptionMessage('Usuário já deu o último lance');
        $usuario = new Usuario('Ganancioso');

        $leilao = new Leilao('Objeto inútil');

        $leilao->recebeLance(new Lance($usuario, 1000));
        $leilao->recebeLance(new Lance($usuario, 1100));
    }

    /**
     * @throws Exception|\PHPUnit\Framework\MockObject\Exception
     */
    public function testAtualizaLeilao()
    {
        $leilao = new Leilao('Brinquedo', new DateTimeImmutable('today'));

        self::createMock(LeilaoDao::class)
            ->method('salva')
            ->with($leilao);

        $leilao->finaliza();

        $leilao->setDescricao('Bola');

        self::createMock(LeilaoDao::class)
            ->method('atualiza')
            ->with($leilao);

        self::assertSame('Bola', $leilao->recuperarDescricao());
        self::assertTrue($leilao->estaFinalizado());
    }

    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function testLeilaoComDataValida(): void
    {
        $leilao = new Leilao('Item 1', new \DateTimeImmutable('today'));
        $leilao->finaliza();

        self::createMock(LeilaoDao::class)
            ->method('salva')
            ->with($leilao);

        self::createMock(LeilaoDao::class)
            ->method('recuperarFinalizados')
            ->willReturn([$leilao]);

        self::assertSame('Item 1', $leilao->recuperarDescricao());
        self::assertEquals('2024-01-22', $leilao->recuperarDataInicio()->format('Y-m-d'));
        self::assertTrue($leilao->estaFinalizado());
    }

    public static function dadosParaProporLances(): array
    {
        $usuario1 = new Usuario('Usuário 1');
        $usuario2 = new Usuario('Usuário 2');
        return [
            [1, [new Lance($usuario1, 1000)]],
            [2, [new Lance($usuario1, 1000), new Lance($usuario2, 2000)]],
        ];
    }
}
