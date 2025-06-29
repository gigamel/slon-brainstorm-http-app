<?php

declare(strict_types=1);

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
    
    $renderer->addRenderer($phpRenderer);
};
