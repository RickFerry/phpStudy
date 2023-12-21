<?php

use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\Exception\ORMException;
use Ferry\Doctrine\Entity\Student;
use Ferry\Doctrine\Helper\EntityManagerCreator;

require_once '../vendor/autoload.php';

try {
    $entityManager = EntityManagerCreator::getEntityManager();
    $repository = $entityManager->getRepository(Student::class);

    $user = $entityManager->find(Student::class, 6);
    $user->setName('William');

    $student = $repository->find(3);
    $student->setName('Kalel');

    $entityManager->flush();
} catch (\Doctrine\DBAL\Exception|MissingMappingDriverImplementation | ORMException $e) {
    echo $e->getMessage();
}
