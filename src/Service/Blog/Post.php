<?php

declare(strict_types=1);

namespace App\Service\Blog;

final readonly class Post
{
    public function __construct(
        public int $id,
        
        public string $slug,
        
        public string $title,
        
        public string $preview,
        
        public string $contents,
    ) {}
}
