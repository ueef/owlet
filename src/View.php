<?php

namespace Ueef\Owlet {

    use Ueef\Owlet\Interfaces\ViewInterface;
    use Ueef\Owlet\Interfaces\EngineInterface;
    use Ueef\Assignable\Traits\AssignableTrait;
    use Ueef\Assignable\Interfaces\AssignableInterface;

    class View implements ViewInterface
    {
        /**
         * @var string[]
         */
        private $dirs = [];

        /**
         * @var EngineInterface[]
         */
        private $engines = [];


        public function __construct(array $dirs, array $engines)
        {
            foreach ($dirs as $dir) {
                $this->dirs[] = $this->correctDirPath($dir);
            }

            $this->engines = $engines;
        }

        public function render(array $views, array $args, ?string $content = null): string
        {
            $content = '';
            foreach ($views as $view) {
                $content = $this->renderView($view, $args, $content);
            }

            return $content;
        }

        private function renderView($view, array &$args, ?string $content = null)
        {
            foreach ($this->resolveViewPaths($view) as $path) {
                foreach ($this->engines as $engine) {
                    if ($engine->exists($path)) {
                        $content = $engine->render($this, $path, $args, $content);
                        break 2;
                    }
                }
            }

            return $content;
        }

        private function resolveViewPaths($viewPaths): array
        {
            if (!is_array($viewPaths)) {
                $viewPaths = [$viewPaths];
            }

            foreach ($viewPaths as &$path) {
                $path = trim($path);
            }

            $resolved = [];
            foreach ($this->dirs as $dir) {
                foreach ($viewPaths as $path) {
                    $resolved[] = $dir . '/' . $path;
                }
            }

            return $resolved;
        }

        private function correctDirPath(string $path)
        {
            return rtrim($path, '/');
        }

        private function correctViewPath(string $path)
        {
            return '/' . trim($path, '/');
        }
    }
}