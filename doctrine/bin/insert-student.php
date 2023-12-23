<?php

use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\Exception\ORMException;
use Ferry\Doctrine\Entity\Phone;
use Ferry\Doctrine\Entity\Student;
use Ferry\Doctrine\Helper\EntityManagerCreator;

require_once '../vendor/autoload.php';

try {
    $entityManager = EntityManagerCreator::getEntityManager();

    $phonalberto = new Student('Phonalberto');
    $phonalberto->setPhones(new Phone('1123456780'));
    $phonalberto->setPhones(new Phone('987654320'));

    $alberphone = new Student('Alberphone');
    $alberphone->setPhones(new Phone('1123456781'));
    $alberphone->setPhones(new Phone('987654321'));

    $ricel = new Student('Ricel');
    $ricel->setPhones(new Phone('1123456782'));
    $ricel->setPhones(new Phone('987654322'));

    $entityManager->persist($alberphone);
    $entityManager->persist($phonalberto);
    $entityManager->persist($ricel);

    $entityManager->flush();
} catch (\Doctrine\DBAL\Exception|MissingMappingDriverImplementation | ORMException $e) {
    echo $e->getMessage();
}
