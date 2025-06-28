<?php

declare(strict_types=1);

use App\Controller\Site\ContactController;
use App\Controller\Site\SiteController;
use Slon\Http\Router\Contract\RoutesCollectionInterface;
use Slon\Http\Router\Route;

return static function (RoutesCollectionInterface $routes): void {
    
    $routes->add(
        new Route(
            name: 'home',
            rule: '/',
            handler: SiteController::class,
        ),
    );
    
    $routes->add(
        new Route(
            name: 'contact',
            rule: '/contact/',
            handler: ContactController::class,
        ),
    );
    
};
