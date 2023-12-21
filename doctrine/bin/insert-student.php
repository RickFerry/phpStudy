<?php

use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\Exception\ORMException;
use Ferry\Doctrine\Entity\Phone;
use Ferry\Doctrine\Entity\Student;
use Ferry\Doctrine\Helper\EntityManagerCreator;

require_once '../vendor/autoload.php';

try {
    $entityManager = EntityManagerCreator::getEntityManager();
    $phone = new Phone('123456789');
    $entityManager->persist($phone);
    $student = new Student('Student with phone', );
    $student->setPhones($phone);
    $entityManager->persist($student);
    $entityManager->flush();
} catch (\Doctrine\DBAL\Exception|MissingMappingDriverImplementation | ORMException $e) {
    echo $e->getMessage();
}
