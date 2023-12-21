<?php

namespace Ferry\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;

#[Entity]
class Course
{
    #[Id, GeneratedValue, Column]
    private int $id;
    #[Column]
    private string $name;
    #[ManyToMany(targetEntity: Student::class, mappedBy: 'courses')]
    private Collection $students;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->students = new ArrayCollection();
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setStudents(Student $student): void
    {
        if (!$this->students->contains($student)){
            return;
        }
        $this->students->add($student);
        $student->enrollInCourse($this);
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getStudents(): Collection
    {
        return $this->students;
    }
}
