<?php

declare(strict_types=1);

use App\Service\Blog\PostRepository;
use Slon\Container\Meta\MetaRegistryInterface;
use Slon\Container\MetaInstance;

return static function (MetaRegistryInterface $registry): void {
    
    $registry->addMeta(
        (new MetaInstance(PostRepository::class)),
    );
    
};
