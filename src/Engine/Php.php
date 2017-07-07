<?php

namespace Ueef\Owlet\Engine {

    use Ueef\Assignable\Interfaces\AssignableInterface;
    use Ueef\Assignable\Traits\AssignableTrait;
    use Ueef\Owlet\Interfaces\EngineInterface;
    use Ueef\Owlet\Interfaces\ViewInterface;

    class Php implements EngineInterface
    {
        /**
         * @var string
         */
        private $extension;


        public function __construct(?string $extension = null)
        {
            $this->extension = $extension;
        }

        public function render(ViewInterface $context, $path, array &$args, ?string $content = null): string
        {
            $path = $this->buildPath($path);
            $renderer = function () use ($path, $content, &$args) {
                extract($args, EXTR_OVERWRITE | EXTR_REFS);

                ob_start();
                require $path;
                return ob_get_clean();
            };

            $renderer = $renderer->bindTo($context);

            return $renderer();
        }

        public function exists(string $path): bool
        {
            return file_exists($this->buildPath($path));
        }

        private function buildPath(string $path)
        {
            if ($this->extension) {
                $path .= '.' . $this->extension;
            }

            return $path;
        }
    }
}
