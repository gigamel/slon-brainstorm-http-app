<?php

declare(strict_types=1);

namespace App\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slon\Http\Kernel\Contract\ApplicationInterface;

final class Application implements ApplicationInterface
{
    public function __construct(
        private ServerRequestMiddlewares $middlewares,
        private RequestHandlerInterface $requestHandler,
    ) {}

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->middlewares->handle($request, $this->requestHandler);
    }
}
