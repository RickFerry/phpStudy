<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Dao\Leilao as LeilaoDao;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Service\Encerrador;
use Alura\Leilao\Service\EnviadorEmail;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class EncerradorTest extends TestCase
{
    private $leiloeiro;
    /** @var MockObject */
    private $enviadorEmail;
    private $brasilia;
    private $fusca;

    protected function setUp(): void
    {
        $this->brasilia = new Leilao('Brasília Amarela', new \DateTimeImmutable('8 days ago'));
        $this->fusca = new Leilao('fusca 1972', new \DateTimeImmutable('10 days ago'));
    
        $leilaoDao = $this->createMock(LeilaoDao::class);
        $leilaoDao->method('recuperarNaoFinalizados')->willReturn([$this->brasilia, $this->fusca]);
        $leilaoDao->method('recuperarFinalizados')->willReturn([$this->brasilia, $this->fusca]);
        $leilaoDao->expects($this->exactly(2))->method('atualiza')->withConsecutive([$this->brasilia], [$this->fusca]);
    
        $this->enviadorEmail = $this->createMock(EnviadorEmail::class);
        $this->leiloeiro = new Encerrador($leilaoDao, $this->enviadorEmail);
    }

    public function testLeiloesComMaisDeUmaSemanaDevemSerEncerrados()
    {
        $this->leiloeiro->encerra();

        $leiloes = [$this->brasilia, $this->fusca];

        self::assertTrue($leiloes[0]->estaFinalizado());
        self::assertTrue($leiloes[1]->estaFinalizado());
        static::assertCount(2, $leiloes);
    }

    public function testDeveContinuarProcessamentoMesmoAoEencontrarErroAoEnviarEmail()
    {
        $this->enviadorEmail->
            expects($this->exactly(2))->
            method('notificarTerminoLeilao')->
            willThrowException(new \DomainException('Erro ao enviar e-mail'));
        $this->leiloeiro->encerra();
    }

    public function testSoDeveEnviarLeilaoPorEmailAposFinalizado()
    {
        $this->enviadorEmail->expects($this->exactly(2))->method('notificarTerminoLeilao')->willReturnCallback(
            function (Leilao $leilao) {
                static::assertTrue($leilao->estaFinalizado());
            }
        );
        $this->leiloeiro->encerra();
    }
}
