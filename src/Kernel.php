<?php

declare(strict_types=1);

namespace App;

use App\Import\ClosureImporter;

final class Kernel
{
    private readonly string $pwd;

    public function __construct(string $pwd)
    {
        $this->pwd = rtrim($pwd, '/');
    }
    
    public function import(string ...$patterns): ClosureImporter
    {
        return new ClosureImporter(...$patterns);
    }
    
    public function pwd(?string $path = null): string
    {
        return $this->pwd . ($path ? '/' . $path : '');
    }
}
