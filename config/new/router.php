<?php

declare(strict_types=1);

use App\Container\Container;
use Slon\Http\Router\Contract\RouterInterface;
use Slon\Http\Router\Contract\RoutesCollectionInterface;
use Slon\Http\Router\Router;
use Slon\Http\Router\RoutesCollection;

return static function (Container $container): void {
    
    $container->add(RoutesCollectionInterface::class, static function (Container $container): RoutesCollectionInterface {
        return new RoutesCollection();
    });
    
    $container->add(RouterInterface::class, static function (Container $container): RouterInterface {
        return new Router($container->get(RoutesCollectionInterface::class));
    });
    
};
