<?php

declare(strict_types=1);

use App\Service\Blog\PostRepository;
use Slon\Container\Contract\RegistryInterface;
use Slon\Container\Instance;

return static function (RegistryInterface $registry): void {
    
    $registry->add(
        (new Instance(PostRepository::class)),
    );
    
};
