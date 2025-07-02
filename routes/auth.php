<?php

declare(strict_types=1);

use App\Controller\Auth\LoginController;
use App\Controller\Auth\LogoutController;
use Slon\Http\Router\Contract\RoutesCollectionInterface;
use Slon\Http\Router\Route;

return static function (RoutesCollectionInterface $routes): void {
    
    $routes->add(
        new Route(
            name: 'login',
            rule: '/admin/login/',
            handler: LoginController::class,
        ),
    );
    
    $routes->add(
        new Route(
            name: 'logout',
            rule: '/admin/logout/',
            handler: LogoutController::class,
        ),
    );
    
};
