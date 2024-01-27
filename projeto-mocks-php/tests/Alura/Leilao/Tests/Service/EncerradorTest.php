<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Dao\Leilao as LeilaoDao;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Service\Encerrador;
use Alura\Leilao\Service\EnviadorEmail;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class EncerradorTest extends TestCase
{
    private Encerrador $leiloeiro;
    private MockObject&EnviadorEmail $enviadorEmail;
    private Leilao $brasilia;
    private Leilao $fusca;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->brasilia = new Leilao('Brasília Amarela', new \DateTimeImmutable('8 days ago'));
        $this->fusca = new Leilao('fusca 1972', new \DateTimeImmutable('10 days ago'));
    
        $leilaoDao = $this->createMock(LeilaoDao::class);
        $leilaoDao->method('recuperarNaoFinalizados')->willReturn([$this->brasilia, $this->fusca]);
        $leilaoDao->method('recuperarFinalizados')->willReturn([$this->brasilia, $this->fusca]);
    
        $this->enviadorEmail = $this->createMock(EnviadorEmail::class);
        $this->leiloeiro = new Encerrador($leilaoDao, $this->enviadorEmail);
    }

    /**
     * @throws \Exception
     */
    public function testLeiloesComMaisDeUmaSemanaDevemSerEncerrados()
    {
        $this->leiloeiro->encerra();

        $leiloes = [$this->brasilia, $this->fusca];

        self::assertTrue($leiloes[0]->estaFinalizado());
        self::assertTrue($leiloes[1]->estaFinalizado());
        self::assertCount(2, $leiloes);
    }

    /**
     * @throws \Exception
     */
    public function testDeveContinuarProcessamentoMesmoEncontrandoErroAoEnviarEmail()
    {
        $this->enviadorEmail->
            expects($this->exactly(2))->
            method('notificarTerminoLeilao')->
            willThrowException(new \DomainException('Erro ao enviar e-mail'));
        $this->leiloeiro->encerra();
    }

    /**
     * @throws \Exception
     */
    public function testSoDeveEnviarLeilaoPorEmailAposFinalizado()
    {
        $this->enviadorEmail
            ->expects($this->exactly(2))
            ->method('notificarTerminoLeilao')
            ->willReturnCallback(function (Leilao $leilao) {
                self::assertTrue($leilao->estaFinalizado());
            });
        $this->leiloeiro->encerra();
    }
}
