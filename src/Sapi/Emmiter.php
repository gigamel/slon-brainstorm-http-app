<?php

declare(strict_types=1);

namespace App\Sapi;

use Psr\Http\Message\ResponseInterface;

final class Emmiter
{
    public function emmit(ResponseInterface $response): void
    {
        if (\headers_sent()) {
            return;
        }
        
        foreach (\array_keys($response->getHeaders()) as $key) {
            \header(\sprintf('%s: %s', $key, $response->getHeaderLine($key)));
        }
        
        \header(
            \sprintf(
                'HTTP/%s %d %s',
                $response->getProtocolVersion(),
                $response->getStatusCode(),
                $response->getReasonPhrase(),
            ),
            true,
            $response->getStatusCode(),
        );
        
        echo $response->getBody()->getContents();
    }
}
