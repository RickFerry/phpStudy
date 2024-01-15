<?php

namespace Alura\Leilao\Model;

class Leilao
{
    /** @var Lance[] */
    private array $lances;
    
    /** @var string */
    private string $descricao;

    private bool $finalizado;

    public function __construct(string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
        $this->finalizado = false;
    }

    public function recebeLance(Lance $lance)
    {
        if (!empty($this->lances) && $this->getLanceRepetido($lance)) {
            throw new \DomainException('Usuário não pode propor 2 lances consecutivos');
        }
        $usuario = $lance->getUsuario();
        $totalLancesUsuario = $this->contarLancesUsuario($usuario);
        if ($totalLancesUsuario >= 5) {
            throw new \DomainException('Usuário não pode propor mais de 5 lances por leilão');
        }

        $this->lances[] = $lance;
    }

    public function estaFinalizado(): bool
    {
        return $this->finalizado;
    }

    /**
     * @return Lance[]
     */
    public function getLances(): array
    {
        return $this->lances;
    }

    public function finaliza()
    {
        $this->finalizado = true;
    }

    private function getLanceRepetido(Lance $lance): bool
    {
        $ultimoLance = $this->getLances()[array_key_last($this->getLances())];
        return $lance->getUsuario() == $ultimoLance->getUsuario();
    }

    private function contarLancesUsuario(Usuario $usuario): int
    {
        return array_reduce(
            $this->lances,
            function (int $totalAcumulado, Lance $lanceAtual) use ($usuario) {
                if ($lanceAtual->getUsuario() == $usuario) {
                    return $totalAcumulado + 1;
                }
                return $totalAcumulado;
            },
            0
        );
    }
}
