<?php

namespace Alura\Leilao\Service;

use DomainException;
use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;

class Avaliador
{
    private float $maiorValor = -INF;
    private float $menorValor = INF;
    private array $maioresLances = [];

    public function avalia(Leilao $leilao)
    {
        if ($leilao->estaFinalizado()) {
            throw new DomainException('Leilão já finalizado');
        }

        if (empty($leilao->getLances())) {
            throw new DomainException('Não é possível avaliar leilão vazio');
        }

        $lances = $leilao->getLances();
        foreach ($lances as $lance) {
            if ($lance->getValor() > $this->maiorValor) {
                $this->maiorValor = $lance->getValor();
            }
            if ($lance->getValor() < $this->menorValor) {
                $this->menorValor = $lance->getValor();
            }
            usort($lances, function (Lance $lance1, Lance $lance2) {
                return $lance2->getValor() - $lance1->getValor();
            });
            $this->maioresLances = array_slice($lances, 0, 3);
        }
    }

    public function getMaioresLances(): array
    {
        return $this->maioresLances;
    }

    public function getMenorValor(): float
    {
        return $this->menorValor;
    }

    /**
     * @return float
     */
    public function getMaiorValor(): float
    {
        return $this->maiorValor;
    }
}
