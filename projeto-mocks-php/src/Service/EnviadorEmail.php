<?php

namespace Alura\Leilao\Service;

use Alura\Leilao\Model\Leilao;

class EnviadorEmail
{
    public function notificarTerminoLeilao(Leilao $leilao): void
    {
        $success = mail(
            'user@user.com',
            'Leilao Finalizado!',
            'Leilão finalizado', 'O leilão para ' . $leilao->recuperarDescricao() . ' foi finalizado'
        );
        if (!$success) {
            throw new \DomainException('Erro ao enviar e-mail');
        }
    }
}
