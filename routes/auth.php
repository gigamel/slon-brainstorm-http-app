<?php

declare(strict_types=1);

use App\Controller\Auth\LoginController;
use Slon\Http\Router\Contract\RoutesCollectionInterface;
use Slon\Http\Router\Route;

return static function (RoutesCollectionInterface $routes): void {
    
    $routes->add(
        new Route(
            name: 'login',
            rule: '/login/',
            handler: LoginController::class,
        ),
    );
    
};
