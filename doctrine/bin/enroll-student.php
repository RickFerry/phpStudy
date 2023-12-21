<?php

use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\Exception\ORMException;
use Ferry\Doctrine\Entity\Course;
use Ferry\Doctrine\Entity\Phone;
use Ferry\Doctrine\Entity\Student;
use Ferry\Doctrine\Helper\EntityManagerCreator;

require_once '../vendor/autoload.php';

try {
    $entityManager = EntityManagerCreator::getEntityManager();

    $student = $entityManager->find(Student::class, 1);
    $course = $entityManager->find(Course::class, 2);
    $student->enrollInCourse($course);

    $entityManager->flush();
} catch (\Doctrine\DBAL\Exception|MissingMappingDriverImplementation | ORMException $e) {
    echo $e->getMessage();
}
