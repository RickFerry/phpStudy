<?php

namespace ContainerMDdMr8b;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class get_ServiceLocator_AGjXrxGService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private '.service_locator.aGjXrxG' shared service.
     *
     * @return \Symfony\Component\DependencyInjection\ServiceLocator
     */
    public static function do($container, $lazyLoad = true)
    {
        return $container->privates['.service_locator.aGjXrxG'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($container->getService ??= $container->getService(...), [
            'season' => ['privates', '.errored..service_locator.aGjXrxG.App\\Entity\\Season', NULL, 'Cannot autowire service ".service_locator.aGjXrxG": it needs an instance of "App\\Entity\\Season" but this type has been excluded in "config/services.yaml".'],
        ], [
            'season' => 'App\\Entity\\Season',
        ]);
    }
}
