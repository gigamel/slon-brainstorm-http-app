<?php

declare(strict_types=1);

namespace App\Controller\Blog;

use App\Renderer\TplRenderer;
use App\Service\Blog\PostRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slon\Http\Protocol\Response;
use Slon\Http\Router\Contract\RoutesCollectionInterface;

final class ListController
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
        $page = $request->getAttribute('page');
        
        if (1 === $page) {
            return new Response(
                '',
                302,
                headers: [
                    'Location' => $this->routes->get('blog_list')->generate(),
                ],
            );
        }
        
        if (null === $page) {
            $page = 1;
        }
        
        return new Response(
            $this->renderer->render(
                'list.tpl',
                ['posts' => $this->repository->getList($page)]
            ),
            headers: [
                'Content-Type' => 'text/html',
            ],
        );
    }
}
