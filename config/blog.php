<?php

declare(strict_types=1);

use App\Container\Container;
use App\Service\Blog\PostRepository;

return static function (Container $container): void {
    
    $container->add(PostRepository::class);
    
};
