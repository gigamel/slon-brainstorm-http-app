<?php

declare(strict_types=1);

use Slon\Container\Meta\MetaRegistryInterface;
use Slon\Http\Router\Contract\RouterInterface;
use Slon\Http\Router\Contract\RoutesCollectionInterface;
use Slon\Http\Router\Router;
use Slon\Http\Router\RoutesCollection;

return [
    'routes' => static function (): RoutesCollectionInterface {
        return new RoutesCollection();
    },
    'router' => static function (MetaRegistryInterface $registry): RouterInterface {
        return new Router($registry->get('routes'));
    },
];
