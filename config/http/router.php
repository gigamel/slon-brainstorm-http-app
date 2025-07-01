<?php

declare(strict_types=1);

use Slon\Container\Meta\MetaRegistryInterface;
use Slon\Container\MetaInstance;
use Slon\Container\Reference;
use Slon\Http\Router\Router;
use Slon\Http\Router\RoutesCollection;

return static function (MetaRegistryInterface $registry): void {
    
    $registry->addMeta(
        new MetaInstance(RoutesCollection::class, 'routes'),
    );
    
    $registry->addMeta(
        (new MetaInstance(Router::class, 'router'))
            ->addArgument('collection', new Reference('routes')),
    );
    
};
