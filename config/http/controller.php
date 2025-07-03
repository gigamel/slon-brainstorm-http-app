<?php

declare(strict_types=1);

use App\Controller\Admin\DashboardController;
use App\Controller\Auth\LoginController;
use App\Controller\Auth\LogoutController;
use App\Controller\Blog\ListController;
use App\Controller\Blog\PostController;
use App\Controller\Site\ContactController;
use App\Controller\Site\ErrorController;
use App\Controller\Site\SiteController;
use App\Service\Blog\PostRepository;
use Slon\Container\Contract\RegistryInterface;
use Slon\Container\Instance;
use Slon\Container\Reference;

return static function (RegistryInterface $registry): void {
    
    $registry->add(
        (new Instance(SiteController::class))
            ->argument('renderer', new Reference('renderer')),
    );
    
    $registry->add(
        (new Instance(ContactController::class))
            ->extends(SiteController::class),
    );
    
    $registry->add(
        (new Instance(ErrorController::class))
            ->extends(SiteController::class),
    );
    
    $registry->add(
        (new Instance(LoginController::class))
            ->extends(SiteController::class),
    );
    
    $registry->add(
        (new Instance(LogoutController::class))
            ->extends(SiteController::class),
    );
    
    $registry->add(
        (new Instance(ListController::class))
            ->extends(SiteController::class)
            ->argument('repository', new Reference(PostRepository::class))
            ->argument('routes', new Reference('routes')),
    );
    
    $registry->add(
        (new Instance(PostController::class))
            ->extends(SiteController::class)
            ->argument('repository', new Reference(PostRepository::class)),
    );
    
    $registry->add(
        (new Instance(DashboardController::class))
            ->extends(SiteController::class),
    );
    
};
