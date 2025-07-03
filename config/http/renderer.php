<?php

declare(strict_types=1);

use Slon\Container\Contract\RegistryInterface;
use Slon\Container\Instance;
use Slon\Container\Reference\OptionReference;
use Slon\Renderer\RendererComposite;

return static function (RegistryInterface $registry): void {
    
    $registry->addOption('views.dir', __DIR__ . '/../../view');
    
    $registry->add(
        (new Instance(RendererComposite::class, 'renderer'))
            ->argument('viewsDir', new OptionReference('views.dir')),
    );
};
