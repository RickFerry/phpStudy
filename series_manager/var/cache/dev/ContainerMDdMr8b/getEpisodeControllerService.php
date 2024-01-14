<?php

namespace ContainerMDdMr8b;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getEpisodeControllerService extends App_KernelDevDebugContainer
{
    /**
     * Gets the public 'App\Controller\EpisodeController' shared autowired service.
     *
     * @return \App\Controller\EpisodeController
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'vendor'.\DIRECTORY_SEPARATOR.'symfony'.\DIRECTORY_SEPARATOR.'framework-bundle'.\DIRECTORY_SEPARATOR.'Controller'.\DIRECTORY_SEPARATOR.'AbstractController.php';
        include_once \dirname(__DIR__, 4).''.\DIRECTORY_SEPARATOR.'src'.\DIRECTORY_SEPARATOR.'Controller'.\DIRECTORY_SEPARATOR.'EpisodeController.php';

        $container->services['App\\Controller\\EpisodeController'] = $instance = new \App\Controller\EpisodeController(($container->privates['App\\Repository\\EpisodeRepository'] ?? $container->load('getEpisodeRepositoryService')));

        $instance->setContainer(($container->privates['.service_locator.jUv.zyj'] ?? $container->load('get_ServiceLocator_JUv_ZyjService'))->withContext('App\\Controller\\EpisodeController', $container));

        return $instance;
    }
}