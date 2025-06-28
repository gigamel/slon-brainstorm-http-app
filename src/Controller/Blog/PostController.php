<?php

declare(strict_types=1);

namespace App\Controller\Blog;

use App\Renderer\TplRenderer;
use App\Service\Blog\PostRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slon\Http\Protocol\Response;
use Slon\Http\Router\Contract\RoutesCollectionInterface;

final class PostController
{
    private readonly TplRenderer $renderer;
    
    public function __construct(
        TplRenderer $renderer,
        private PostRepository $repository,
        private readonly RoutesCollectionInterface $routes,
    ) {
        $this->renderer = $renderer->withNamespace('blog');
    }
    
    public function __invoke(ServerRequestInterface $request): ResponseInterface
    {
        $post = $this->repository->getBySlug(
            $request->getAttribute('slug'),
        );
        
        if (!$post) {
            throw new \RuntimeException('Page Not Found');
        }
        
        $backward = $request->getQueryParams()['from']
            ?? $this->routes->get('blog_list')->generate();
        
        return new Response(
            $this->renderer->render(
                'post.tpl',
                [
                    'post' => $post,
                    'backward' => $backward,
                ],
            ),
            headers: [
                'Content-Type' => 'text/html',
            ],
        );
    }
}
