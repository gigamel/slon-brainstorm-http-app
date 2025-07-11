<?php

declare(strict_types=1);

namespace App\Controller\Blog;

use App\Service\Blog\PostRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RuntimeException;
use Slon\Http\Protocol\Response;
use Slon\Renderer\Contract\RendererCompositeInterface;

final class PostController
{
    public function __construct(
        private readonly RendererCompositeInterface $renderer,
        private PostRepository $repository,
    ) {}
    
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $post = $this->repository->getBySlug(
            $request->getAttribute('slug'),
        );
        
        if (!$post) {
            throw new RuntimeException('Page Not Found');
        }
        
        return new Response(
            $this->renderer->render(
                'blog/post.php',
                [
                    'post' => $post,
                    'backward' => $request->getQueryParams()['from'] ?? null,
                ],
            ),
            headers: [
                'Content-Type' => 'text/html',
            ],
        );
    }
}
