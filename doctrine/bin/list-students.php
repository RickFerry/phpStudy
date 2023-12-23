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
    $all = $repository->studentsPhonesAndCourses();
    foreach ($all as $student) {
        echo $student->getName() . PHP_EOL;
        echo implode(',',
                $student->getPhones()->map(fn(Phone $phone) => $phone->getNumber())->toArray()) . PHP_EOL;
        echo implode(',',
                $student->getCourses()->map(fn(Course $course) => $course->getName())->toArray()) . PHP_EOL;
    }

    $students = $repository->findBy(['name' => 'Alberphone']);
    echo $students[0]->getName() . PHP_EOL;

    $one = $repository->findOneBy(['id' => 2]);
    echo $one->getName() . PHP_EOL;

    $dql2 = 'SELECT COUNT(student) FROM Ferry\Doctrine\Entity\Student student';
    $dql3 = 'SELECT COUNT(student) FROM Ferry\Doctrine\Entity\Student student WHERE SIZE(student.phones) >= 2';
    $dql4 = 'SELECT COUNT(student) FROM Ferry\Doctrine\Entity\Student student WHERE student.phones IS EMPTY';

    var_dump($entityManager->createQuery($dql2)->getSingleScalarResult());
    var_dump($entityManager->createQuery($dql3)->getSingleScalarResult());

    $query = $entityManager->createQuery($dql4)->enableResultCache(86400);
    $singleScalarResult = $query->getSingleScalarResult();
    var_dump($singleScalarResult);

    echo count($all) . PHP_EOL;

    echo $repository->find(1)->getName() . PHP_EOL;
} catch (\Doctrine\DBAL\Exception|MissingMappingDriverImplementation|ORMException $e) {
    echo $e->getMessage();
}
