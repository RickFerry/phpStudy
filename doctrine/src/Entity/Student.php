<?php

namespace Ferry\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;
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
    #[ManyToMany(targetEntity: Course::class, inversedBy: 'students')]
    private Collection $courses;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->phones = new ArrayCollection();
        $this->courses = new ArrayCollection();
    }

    public function getCourses(): Collection
    {
        return $this->courses;
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

    public function enrollInCourse(Course $course): void
    {
        if ($this->courses->contains($course)) {
            return;
        }
        $this->courses->add($course);
        $course->setStudents($this);
    }
}
