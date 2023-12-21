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
    $repository = $entityManager->getRepository(Student::class);
    $all = $repository->findAll();
    foreach ($all as $student) {
        echo $student->getName() . PHP_EOL;
        echo implode(',',
                $student->getPhones()->map(fn(Phone $phone) => $phone->getNumber())->toArray()) . PHP_EOL;
        echo implode(',',
                $student->getCourses()->map(fn(Course $course) => $course->getName())->toArray()) . PHP_EOL;
    }

    $students = $repository->findBy(['name' => 'Gael']);
    echo $students[0]->getName() . PHP_EOL;

    $one = $repository->findOneBy(['id' => 4]);
    echo $one->getName() . PHP_EOL;

    echo $repository->count([]) . PHP_EOL;

    echo $repository->find(1)->getName() . PHP_EOL;
} catch (\Doctrine\DBAL\Exception|MissingMappingDriverImplementation|ORMException $e) {
    echo $e->getMessage();
}
