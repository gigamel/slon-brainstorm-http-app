<?php

declare(strict_types=1);

namespace App\Container;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    protected array $services = [];

    public function get(string $id): object
    {
        if (!\array_key_exists($id, $this->services)) {
            throw new \InvalidArgumentException('service not found');
        }
        
        $service = $this->services[$id];
        if ($service instanceof \Closure) {
            $service = $service($this);
        } elseif (is_string($service)) {
            $service = new $service();
        } else {
            return $service;
        }

        return $this->services[$id] = $service;
    }
    
    public function has(string $id): bool
    {
        return \array_key_exists($id, $this->services);
    }
    
    public function add(string $id, ?object $service = null): void
    {
        if (\is_object($service)) {
            $this->services[$id] = $service;
            return;
        }
        
        if (!\class_exists($id)) {
            throw new \InvalidArgumentException('class not found');
        }
        
        $this->services[$id] = $id;
    }
}
