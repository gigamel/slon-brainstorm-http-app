<?php

declare(strict_types=1);

namespace App\Http;

use Slon\Container\Contract\RegistryInterface;

final readonly class ControllerResolver
{
    public function __construct(
        private RegistryInterface $container,
    ) {}
    
    public function resolve(string $className): object
    {
        if ($this->container->has($className)) {
            return $this->container->get($className);
        }
        
        return new $className();
    }
}
