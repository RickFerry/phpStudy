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

    $stdt1 = $entityManager->find(Student::class, 1);
    $crs1 = $entityManager->find(Course::class, 2);
    $crs2 = $entityManager->find(Course::class, 3);
    $stdt1->enrollInCourse($crs1);
    $stdt1->enrollInCourse($crs2);

    $stdt2 = $entityManager->find(Student::class, 2);
    $crs3 = $entityManager->find(Course::class, 1);
    $crs4 = $entityManager->find(Course::class, 3);
    $stdt2->enrollInCourse($crs1);
    $stdt2->enrollInCourse($crs2);

    $entityManager->flush();
} catch (\Doctrine\DBAL\Exception|MissingMappingDriverImplementation | ORMException $e) {
    echo $e->getMessage();
}
