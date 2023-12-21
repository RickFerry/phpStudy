<?php

namespace Ferry\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;

#[Entity]
class Student
{
    #[Id, Column, GeneratedValue]
    private int $id;
    #[Column]
    private string $name;
    #[OneToMany(mappedBy: 'student', targetEntity: Phone::class, cascade: ['persist', 'remove'])]
    private Collection $phones;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->phones = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setPhones(Phone $phones): void
    {
        $this->phones->add($phones);
        $phones->setStudent($this);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPhones(): Collection
    {
        return $this->phones;
    }
}
