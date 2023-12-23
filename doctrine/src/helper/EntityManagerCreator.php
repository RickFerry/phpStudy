<?php

namespace Ferry\Doctrine\Helper;

use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Exception;
use Doctrine\DBAL\Logging\Middleware;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Exception\MissingMappingDriverImplementation;
use Doctrine\ORM\ORMSetup;
use Symfony\Component\Cache\Adapter\PhpFilesAdapter;
use Symfony\Component\Cache\Exception\CacheException;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\OutputInterface;

class EntityManagerCreator
{
    /**
     * @throws MissingMappingDriverImplementation
     * @throws Exception|CacheException
     */
    public static function getEntityManager(): EntityManager
    {
        $cacheDirectory = __DIR__ . '/../../var/cache';

        $config = ORMSetup::createAttributeMetadataConfiguration(
            paths: [__DIR__ . "/../"],
            isDevMode: true,
        );
        $consoleOutput = new ConsoleOutput(OutputInterface::VERBOSITY_DEBUG);
        $consoleLogger = new ConsoleLogger($consoleOutput);
        $middleware = new Middleware($consoleLogger);
        $config->setMiddlewares([$middleware]);

        $config->setMetadataCache(
            new PhpFilesAdapter(
                'metadata',
                0,
                $cacheDirectory
            )
        );

        $config->setQueryCache(
            new PhpFilesAdapter(
                'query-metadata',
                0,
                $cacheDirectory
            )
        );

        $config->setResultCache(
            new PhpFilesAdapter(
                'result-metadata',
                0,
                $cacheDirectory
            )
        );

        $connection = DriverManager::getConnection([
            'driver' => 'pdo_sqlite',
            'path' => __DIR__ . '/../../db.sqlite',
        ], $config);

        return new EntityManager($connection, $config);
    }
}
