<?php

declare(strict_types=1);

use App\Renderer\BlocksExtension;
use App\Renderer\RouteExtension;
use Slon\Container\Meta\MetaRegistryInterface;
use Slon\Renderer\Contract\RendererCompositeInterface;
use Slon\Renderer\PhpRenderer;
use Slon\Renderer\QuotesExtension;

return static function (MetaRegistryInterface $registry): void {
    if (!$registry->has('renderer')) {
        return;
    }
    
    $renderer = $registry->get('renderer');
    if (!$renderer instanceof RendererCompositeInterface) {
        return;
    }
    
    $phpRenderer = new PhpRenderer();
    $phpRenderer->addExtension(new QuotesExtension());
    
    $phpRenderer->addExtension(
        new BlocksExtension($registry->getParameter('views.dir')),
    );
    
    $renderer->addRenderer($phpRenderer);
    
    if ($registry->has('routes')) {
        $phpRenderer->addExtension(
            new RouteExtension($registry->get('routes')),
        );
    }
};
