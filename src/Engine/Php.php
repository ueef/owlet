<?php

namespace Ueef\Owlet\Engine {

    use Ueef\Owlet\Interfaces\ViewInterface;
    use Ueef\Owlet\Interfaces\EngineInterface;

    class Php implements EngineInterface
    {
        public function render(ViewInterface $context, $path, array &$args, ?string $content = null): ?string
        {
            $renderer = function () use ($path, $content, &$args) {
                extract($args, EXTR_OVERWRITE | EXTR_REFS);

                ob_start();
                require $path;
                return ob_get_clean();
            };

            $renderer = $renderer->bindTo($context);

            return $renderer();
        }
    }
}
