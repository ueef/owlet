<?php

namespace Ueef\Owlet {

    use Ueef\Owlet\Interfaces\ViewInterface;
    use Ueef\Owlet\Interfaces\EngineInterface;
    use Ueef\Owlet\Exceptions\CantResolvePathsException;
    use Ueef\Assignable\Traits\AssignableTrait;
    use Ueef\Assignable\Interfaces\AssignableInterface;

    class View implements ViewInterface, AssignableInterface
    {
        use AssignableTrait;

        /**
         * @var EngineInterface[]
         */
        private $engines = [];

        /**
         * @var string[]
         */
        private $dirs = [];

        public function render(array $paths, array $args, string $content = null): string
        {
            foreach ($this->resolvePath($paths) as $path) {
                foreach ($this->engines as $engine) {
                    if ($engine->exists($path)) {
                        return $engine->render($this, $path, $args, $content);
                    }
                }
            }

            throw new CantResolvePathsException('View not exists');
        }

        private function resolvePath(string $path): array
        {
            return [];
        }
    }
}