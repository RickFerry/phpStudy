<?php

require_once 'vendor/autoload.php';

use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\Configuration\Migration\PhpFile;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Ferry\Doctrine\Helper\EntityManagerCreator;

try {
    $config = new PhpFile(__DIR__ . '/migrations.php');
    return DependencyFactory::fromEntityManager(
        $config,
        new ExistingEntityManager(EntityManagerCreator::getEntityManager())
    );
} catch (\Doctrine\DBAL\Exception|MissingMappingDriverImplementation $e) {
    echo $e->getMessage();
}
