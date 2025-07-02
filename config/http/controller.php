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
use Slon\Container\Meta\MetaRegistryInterface;
use Slon\Container\MetaInstance;
use Slon\Container\Reference;

return static function (MetaRegistryInterface $registry): void {
    
    $registry->addMeta(
        (new MetaInstance(SiteController::class))
            ->addArgument('renderer', new Reference('renderer')),
    );
    
    $registry->addMeta(
        (new MetaInstance(ContactController::class))
            ->extends(SiteController::class),
    );
    
    $registry->addMeta(
        (new MetaInstance(ErrorController::class))
            ->extends(SiteController::class),
    );
    
    $registry->addMeta(
        (new MetaInstance(LoginController::class))
            ->extends(SiteController::class),
    );
    
    $registry->addMeta(
        (new MetaInstance(LogoutController::class))
            ->extends(SiteController::class),
    );
    
    $registry->addMeta(
        (new MetaInstance(ListController::class))
            ->extends(SiteController::class)
            ->addArgument('repository', new Reference(PostRepository::class))
            ->addArgument('routes', new Reference('routes')),
    );
    
    $registry->addMeta(
        (new MetaInstance(PostController::class))
            ->extends(SiteController::class)
            ->addArgument('repository', new Reference(PostRepository::class)),
    );
    
    $registry->addMeta(
        (new MetaInstance(DashboardController::class))
            ->extends(SiteController::class),
    );
    
};
