<?php

use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\Exception\ORMException;
use Ferry\Doctrine\Entity\Student;
use Ferry\Doctrine\Helper\EntityManagerCreator;

require_once '../vendor/autoload.php';

try {
    $entityManager = EntityManagerCreator::getEntityManager();
    $repository = $entityManager->getRepository(Student::class);
    $all = $repository->findAll();
    foreach ($all as $student){
        echo $student->getName().PHP_EOL;
    }

    $students = $repository->findBy(['name' => 'Gael']);
    echo $students[0]->getName().PHP_EOL;

    $one = $repository->findOneBy(['id' => 4]);
    echo $one->getName().PHP_EOL;

    echo $repository->count([]).PHP_EOL;

    echo $repository->find(5)->getName().PHP_EOL;
} catch (\Doctrine\DBAL\Exception|MissingMappingDriverImplementation | ORMException $e) {
    echo $e->getMessage();
}
