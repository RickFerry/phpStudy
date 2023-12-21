<?php

namespace Ferry\Doctrine\Entity;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;

#[Entity]
class Student
{
    #[Column]
    #[Id] #[GeneratedValue]
    public readonly int $id;

    /**
     * @param string $name
     */
    public function __construct(#[Column] public readonly string $name)
    {
    }
}