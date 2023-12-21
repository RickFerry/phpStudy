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

    $doctrine = new Course('Doctrine');
    $java = new Course('Java');
    $php = new Course('PHP');

    $entityManager->persist($doctrine);
    $entityManager->persist($java);
    $entityManager->persist($php);

    $entityManager->flush();
} catch (\Doctrine\DBAL\Exception|MissingMappingDriverImplementation | ORMException $e) {
    echo $e->getMessage();
}
