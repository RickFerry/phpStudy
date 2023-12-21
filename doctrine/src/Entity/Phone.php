<?php

namespace Ferry\Doctrine\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;

#[Entity]
class Phone
{
    #[Id, Column, GeneratedValue]
    private int $id;
    #[Column]
    private string $number;
    #[ManyToOne(targetEntity: Student::class, inversedBy: 'phones')]
    private Student $student;

    /**
     * @param string $number
     */
    public function __construct(string $number)
    {
        $this->number = $number;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getStudent(): Student
    {
        return $this->student;
    }

    public function setNumber(string $number): void
    {
        $this->number = $number;
    }

    public function setStudent(Student $student): void
    {
        $this->student = $student;
    }

}
