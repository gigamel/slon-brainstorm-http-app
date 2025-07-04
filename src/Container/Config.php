<?php

declare(strict_types=1);

namespace App\Container;

class Config
{
    protected array $configs = [];

    public function getOption(string $name, mixed $default = null): mixed
    {
        return $this->configs[$name] ?? $default;
    }
    
    public function addOption(string $name, mixed $value): void
    {
        $this->configs[$name] = $value;
    }
}
