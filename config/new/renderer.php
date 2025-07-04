<?php

declare(strict_types=1);

use App\Container\Config;
use App\Container\Container;
use Slon\Renderer\Contract\RendererCompositeInterface;
use Slon\Renderer\RendererComposite;

return static function (Container $container): void {
    
    $container->add(RendererCompositeInterface::class, static function (Container $container): RendererCompositeInterface {
        $container->get(Config::class)->addOption('views.dir', __DIR__ . '/../../view');
        
        return new RendererComposite(
            $container->get(Config::class)->getOption('views.dir'),
        );
    });
};
