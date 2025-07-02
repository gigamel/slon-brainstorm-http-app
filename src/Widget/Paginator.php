<?php

declare(strict_types=1);

namespace App\Widget;

final readonly class Paginator
{
    public function __construct(
        private int $count,
        private int $page,
        private int $limit,
    ) {}
    
    public function getPages(): int
    {
        return (int) ceil($this->count / $this->limit);
    }
    
    public function getPage(): int
    {
        return $this->page;
    }
    
    public function isLimited(): bool
    {
        return $this->getPages() < $this->getPage();
    }
}
