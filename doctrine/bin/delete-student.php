<?php

use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\Exception\ORMException;
use Ferry\Doctrine\Entity\Student;
use Ferry\Doctrine\Helper\EntityManagerCreator;

require_once '../vendor/autoload.php';

try {
    $entityManager = EntityManagerCreator::getEntityManager();

    $user = $entityManager->find(Student::class, 6);
    $entityManager->remove($user);

    $reference = $entityManager->getReference(Student::class, 3);
    $entityManager->remove($reference);

    $entityManager->flush();
} catch (\Doctrine\DBAL\Exception|MissingMappingDriverImplementation | ORMException $e) {
    echo $e->getMessage();
}
