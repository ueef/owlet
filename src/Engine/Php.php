<?php

declare(strict_types=1);

namespace Ueef\Owlet\Engine;

use Ueef\Owlet\Interfaces\EngineInterface;
use Ueef\Owlet\Interfaces\ViewInterface;

class Php implements EngineInterface
{
    public function render(ViewInterface $context, string $path, array &$args, ?string $content = null): ?string
    {
        $renderer = function () use ($path, $content, &$args) {
            extract($args, EXTR_OVERWRITE | EXTR_REFS);

            ob_start();
            require $path;
            return ob_get_clean();
        };

        return $renderer->bindTo($context, $context)();
    }
}
