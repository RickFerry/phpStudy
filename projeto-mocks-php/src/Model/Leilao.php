<?php

namespace Alura\Leilao\Model;

use DateTimeInterface;

class Leilao
{
    private array $lances;
    private string $descricao;
    private bool $finalizado;
    private DateTimeInterface|\DateTimeImmutable $dataInicio;
    private ?int $id;

    public function __construct(string $descricao, \DateTimeImmutable $dataInicio = null, int $id = null)
    {
        $this->descricao = $descricao;
        $this->finalizado = false;
        $this->lances = [];
        $this->dataInicio = $dataInicio ?? new \DateTimeImmutable();
        $this->id = $id;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function recebeLance(Lance $lance): void
    {
        if ($this->finalizado) {
            throw new \DomainException('Este leilão já está finalizado');
        }

        $ultimoLance = empty($this->lances) ? null : $this->lances[array_key_last($this->lances)];
        if (!empty($this->lances) && $ultimoLance->getUsuario() === $lance->getUsuario()) {
            throw new \DomainException('Usuário já deu o último lance');
        }
        $this->lances[] = $lance;
    }

    public function finaliza(): void
    {
        $this->finalizado = true;
    }

    /**
     * @return Lance[]
     */
    public function getLances(): array
    {
        return $this->lances;
    }

    public function recuperarDescricao(): string
    {
        return $this->descricao;
    }

    public function estaFinalizado(): bool
    {
        return $this->finalizado;
    }

    public function recuperarDataInicio(): DateTimeInterface
    {
        return $this->dataInicio;
    }

    public function temMaisDeUmaSemana(): bool
    {
        $hoje = new \DateTime();
        $intervalo = $this->dataInicio->diff($hoje);

        return $intervalo->days > 7;
    }

    public function recuperarId(): int
    {
        return $this->id;
    }
}
