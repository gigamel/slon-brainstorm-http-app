<?php

declare(strict_types=1);

namespace App\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use function array_shift;

final class ServerRequestMiddlewares
{
    private array $middlewares = [];
    
    /**
     * @param list<MiddlewareInterface> $middlewares
     */
    public function __construct(
        array $middlewares = [],
    ) {
        foreach ($middlewares as $middleware) {
            $this->addMiddleware($middleware);
        }
    }
    
    public function handle(
        ServerRequestInterface $request,
        RequestHandlerInterface $requestHandler,
    ): ResponseInterface {
        if ($middleware = array_shift($this->middlewares)) {
            return $middleware->process($request, $requestHandler);
        }
        
        return $requestHandler->handle($request);
    }
    
    public function addMiddleware(MiddlewareInterface $middleware): void
    {
        $this->middlewares[] = $middleware;
    }
}
