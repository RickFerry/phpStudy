<?php

namespace Alura\Leilao\Model;

class Leilao
{
    /** @var Lance[] */
    private array $lances;
    /** @var string */
    private string $descricao;

    public function __construct(string $descricao)
    {
        $this->descricao = $descricao;
        $this->lances = [];
    }

    public function recebeLance(Lance $lance)
    {
        if (!empty($this->lances) && $this->getLanceRepetido($lance)) {
            return;
        }
        $this->lances[] = $lance;
    }

    /**
     * @return Lance[]
     */
    public function getLances(): array
    {
        return $this->lances;
    }

    private function getLanceRepetido(Lance $lance): bool
    {
        $ultimoLance = $this->getLances()[count($this->getLances()) - 1];
        return $lance->getUsuario() == $ultimoLance->getUsuario();
    }
}
