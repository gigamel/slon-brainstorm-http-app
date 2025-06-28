<?php

declare(strict_types=1);

use App\Sapi\Emmiter;

return [
    'sapi_emmiter' => static function (): Emmiter {
        return new Emmiter();
    },
];
