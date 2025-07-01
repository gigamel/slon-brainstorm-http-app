<?php

declare(strict_types=1);

namespace App;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slon\Container\Container;
use Slon\Container\MetaRegistry;
use Slon\Http\Kernel\AbstractKernel;
use Slon\Http\Kernel\Configuration\ArrayProvider;
use Slon\Http\Kernel\Import\ClosureImporter;
use Slon\Http\Protocol\Factory\ServerRequestFactory;

final class HttpKernel extends AbstractKernel
{
    private ?ContainerInterface $container = null;
    
    private readonly string $pwd;

    public function __construct(string $pwd)
    {
        parent::__construct();
        $this->pwd = rtrim($pwd, '/');
    }
    
    protected function getContainer(): ContainerInterface
    {
        if ($this->container) {
            return $this->container;
        }
        
        $registry = new MetaRegistry(
            (new ArrayProvider(
                $this->pwd('kernel/common/*.php'),
                $this->pwd('kernel/http/*.php'),
            ))->getArray(),
        );
        
        $this->import(
            $this->pwd('config/*.php'),
            $this->pwd('extension/*.php'),
        )->withArgs($registry);
        
        $this->container = new Container($registry);
        
        $this->import(
            $this->pwd('routes/*.php'),
        )->withArgs($this->container->get('routes'));
        
        return $this->container;
    }
    
    protected function getServerRequest(): ServerRequestInterface
    {
        return ServerRequestFactory::fromGlobals();
    }
    
    private function import(string ...$patterns): ClosureImporter
    {
        return new ClosureImporter(...$patterns);
    }
    
    private function pwd(?string $path = null): string
    {
        return $this->pwd . ($path ? '/' . $path : '');
    }
}
