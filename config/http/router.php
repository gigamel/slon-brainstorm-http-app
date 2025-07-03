<?php

declare(strict_types=1);

use Slon\Container\Contract\RegistryInterface;
use Slon\Container\Instance;
use Slon\Container\Reference;
use Slon\Http\Router\Router;
use Slon\Http\Router\RoutesCollection;

return static function (RegistryInterface $registry): void {
    
    $registry->add(
        new Instance(RoutesCollection::class, 'routes'),
    );
    
    $registry->add(
        (new Instance(Router::class, 'router'))
            ->argument('collection', new Reference('routes')),
    );
    
};
