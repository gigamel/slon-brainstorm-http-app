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
        if ($redirectResponse = $this->firstPageProcess($request)) {
            return $redirectResponse;
        }
        
        $paginator = new Paginator(
            $this->repository->getCount(),
            $request->getAttribute('page') ?? 1,
            3,
        );
        
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
                    'page' => $request->getUri()->getPath(),
                ],
            ),
            headers: [
                'Content-Type' => 'text/html',
            ],
        );
    }
    
    private function firstPageProcess(
        ServerRequestInterface $request,
    ): ?ResponseInterface {
        if ($request->getAttribute('page') === 1) {
            return new Response(
                '',
                302,
                headers: [
                    'Location' => $this->routes->get('blog_list')->generate(),
                ],
            );
        }
        
        return null;
    }
}
