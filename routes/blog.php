<?php

declare(strict_types=1);

use App\Controller\Blog\ListController;
use Slon\Http\Router\Contract\RoutesCollectionInterface;
use Slon\Http\Router\Route;

return static function (RoutesCollectionInterface $routes): void {
    
    $routes->add(
        new Route(
            name: 'blog_list',
            rule: '/blog(/{page})?',
            handler: ListController::class,
            segments: [
                'page' => '[1-9][0-9]*',
            ],
        ),
    );
    
};
