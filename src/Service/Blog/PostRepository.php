<?php

declare(strict_types=1);

namespace App\Service\Blog;

final class PostRepository
{
    private const array POSTS = [
        0 => [
            'id' => 1,
            'slug' => 'what-is-it',
            'title' => 'What is Lorem Ipsum?',
            'preview' => 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'contents' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        ],
        1 => [
            'id' => 2,
            'slug' => 'where-does-it',
            'title' => 'Where does it come from?',
            'preview' => 'Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'contents' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        ],
        2 => [
            'id' => 3,
            'slug' => 'we-use-it',
            'title' => 'We use it',
            'preview' => 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'contents' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
        ],
        3 => [
            'id' => 4,
            'slug' => 'latin-words',
            'title' => 'Latin words',
            'preview' => 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.',
            'contents' => 'You need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.',
        ],
        4 => [
            'id' => 5,
            'slug' => 'standard-chunk',
            'title' => 'Standard Chunk',
            'preview' => 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested.',
            'contents' => 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.',
        ],
    ];
    
    private ?int $count = null;

    public function getList(int $offset = 1, int $limit = 3): iterable
    {
        $min = ($offset - 1) * $limit;
        $max = $min + $limit - 1;
        
        if ($this->getCount() < $max) {
            return [];
        }
        
        $posts = [];
        for ($position = $min; $position <= $max; $position++) {
            if (isset(self::POSTS[$position])) {
                $posts[] = new Post(...self::POSTS[$position]);
            }
        }
        
        return $posts;
    }
    
    public function getCount(): int
    {
        if (null === $this->count) {
            $this->count = count(self::POSTS);
        }
        
        return $this->count;
    }
    
    public function getBySlug(string $slug): ?Post
    {
        foreach (self::POSTS as $post) {
            if ($slug === ($post['slug'] ?? null)) {
                return new Post(...$post);
            }
        }
        
        return null;
    }
}
