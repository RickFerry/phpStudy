<?php

namespace Alura\Leilao\Tests\Service;

use Alura\Leilao\Dao\Leilao as LeilaoDao;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Service\Encerrador;
use PHPUnit\Framework\TestCase;

class LeilaoDaoMock extends LeilaoDao
{
    private $leiloes = [];

    public function salva(Leilao $leilao): void
    {
        $this->leiloes[] = $leilao;
    }

    public function recuperarNaoFinalizados(): array
    {
        return array_filter($this->leiloes, function (Leilao $leilao) {
            return !$leilao->estaFinalizado();
        });
    }

    public function recuperarFinalizados(): array
    {
        return array_filter($this->leiloes, function (Leilao $leilao) {
            return $leilao->estaFinalizado();
        });
    }

    public function atualiza(Leilao $leilao): void
    {
    }
}

class EncerradorTest extends TestCase
{
    public function testLeiloesComMaisDeUmaSemanaDevemSerEncerrados()
    {
        $brasilia = new Leilao('Brasília Amarela', new \DateTimeImmutable('8 days ago'));
        $fusca = new Leilao('Fusca 1972', new \DateTimeImmutable('10 days ago'));

        $leilaoDao = new LeilaoDaoMock();
        $leilaoDao->salva($brasilia);
        $leilaoDao->salva($fusca);

        $leiloeiro = new Encerrador($leilaoDao);
        $leiloeiro->encerra();

        $leiloes = $leilaoDao->recuperarFinalizados();

        static::assertCount(2, $leiloes);
        static::assertEquals('Brasília Amarela', $leiloes[0]->recuperarDescricao());
        static::assertEquals('Fusca 1972', $leiloes[1]->recuperarDescricao());
    }
}
