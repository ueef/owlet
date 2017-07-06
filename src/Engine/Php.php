<?php

namespace Ueef\Owlet\Engine {

    use Ueef\Assignable\Interfaces\AssignableInterface;
    use Ueef\Assignable\Traits\AssignableTrait;
    use Ueef\Owlet\Interfaces\EngineInterface;
    use Ueef\Owlet\Interfaces\ViewInterface;

    class Php implements EngineInterface, AssignableInterface
    {
        use AssignableTrait;

        /**
         * @var string
         */
        private $extension;


        public function render(ViewInterface $context, $path, array &$args, string $content = ''): callable
        {
            $renderer = function () use ($path, $content, &$args) {
                extract($args, EXTR_OVERWRITE | EXTR_REFS);
                include $path;
            };
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
