<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Dao\Leilao as LeilaoDao;
use Exception;

class Encerrador
{
    private LeilaoDao $dao;
    private EnviadorEmail $email;

    public function __construct(leilaoDao $dao, EnviadorEmail $email)
    {
        $this->dao = $dao;
        $this->email = $email;
    }

    /**
     * @throws Exception
     */
    public function encerra(): void
    {
        $leiloes = $this->dao->recuperarNaoFinalizados();

        foreach ($leiloes as $leilao) {
            if ($leilao->temMaisDeUmaSemana()) {
                try {
                    $leilao->finaliza();
                    $this->dao->atualiza($leilao);
                    $this->email->notificarTerminoLeilao($leilao);
                } catch (\DomainException $e) {
                    error_log($e->getMessage());
                }
            }
        }
    }
}
