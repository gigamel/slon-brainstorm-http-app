<?php

declare(strict_types=1);

namespace App\Controller\Blog;

use App\Service\Blog\PostRepository;
use App\Widget\Paginator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slon\Http\Kernel\Exception\HttpException;
use Slon\Http\Protocol\Response;
use Slon\Http\Router\Contract\RoutesCollectionInterface;
use Slon\Renderer\Contract\RendererCompositeInterface;

final class ListController
{
    public function __construct(
        private readonly RendererCompositeInterface $renderer,
        private PostRepository $repository,
        private readonly RoutesCollectionInterface $routes,
    ) {}
    
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
        
        $paginator = new Paginator($this->repository->getCount(), $page, 3);
        
        if ($paginator->isLimited()) {
            throw new HttpException('Page Not Found', 404);
        }
        
        return new Response(
            $this->renderer->render(
                'blog/list.php',
                [
                    'posts' => $this->repository->getList(
                        $paginator->getPage(),
                    ),
                    'paginator' => $paginator,
                    'route' => $this->routes->get('blog_list'),
                ],
            ),
            headers: [
                'Content-Type' => 'text/html',
            ],
        );
    }
}
