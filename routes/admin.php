<?php

declare(strict_types=1);

use App\Controller\Admin\DashboardController;
use Slon\Http\Router\Contract\RoutesCollectionInterface;
use Slon\Http\Router\Route;

return static function (RoutesCollectionInterface $routes): void {
    
    $routes->add(
        new Route(
            name: 'admin_dashboard',
            rule: '/admin/',
            handler: DashboardController::class,
        ),
    );
    
};
