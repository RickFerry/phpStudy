<?php

use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;
use Ferry\Doctrine\Helper\EntityManagerCreator;

require_once __DIR__ . '/../vendor/autoload.php';

try {
    $entityManager = EntityManagerCreator::getEntityManager();
    ConsoleRunner::run(new SingleManagerProvider($entityManager));
} catch (\Doctrine\DBAL\Exception|MissingMappingDriverImplementation $e) {
}
