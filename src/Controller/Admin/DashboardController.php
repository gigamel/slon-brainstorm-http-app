<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slon\Http\Protocol\Response;
use Slon\Renderer\Contract\RendererCompositeInterface;

final readonly class DashboardController
{
    public function __construct(
        private readonly RendererCompositeInterface $renderer,
    ) {}
    
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        return new Response(
            $this->renderer->render('admin/dashboard.php'),
            headers: [
                'Content-Type' => 'text/html',
            ],
        );
    }
}
