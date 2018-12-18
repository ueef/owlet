<?php

namespace Ueef\Owlet {

    use Ueef\Owlet\Interfaces\ViewInterface;
    use Ueef\Owlet\Interfaces\EngineInterface;

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


        public function __construct($dirs, $engines)
        {
            foreach ($dirs as $dir) {
                $this->dirs[] = $this->correctDirPath($dir);
            }

            $this->engines = $engines;
        }

        public function render($views, array $args = [], $content = null)
        {
            if (!is_array($views)) {
                $views = [$views];
            }

            foreach ($views as $view) {
                $content = $this->renderView($view, $args, $content);
            }

            return $content;
        }

        private function renderView($view, array &$args, $content = null)
        {
            foreach ($this->resolvePaths($view) as $path) {
                foreach ($this->engines as $suffix => $engine) {
                    $_path = $path . $suffix;

                    if (file_exists($_path)) {
                        $content = $engine->render($this, $_path, $args, $content);
                        break 2;
                    }
                }
            }

            return $content;
        }

        private function resolvePaths($paths)
        {
            if (!is_array($paths)) {
                $paths = [$paths];
            }

            $resolved = [];
            foreach ($paths as $path) {
                $path = $this->correctViewPath($path);

                foreach ($this->dirs as $dir) {
                    $resolved[] = $dir . $path;
                }
            }

            return $resolved;
        }

        private function correctDirPath($path)
        {
            return rtrim($path, '/');
        }

        private function correctViewPath($path)
        {
            return '/' . trim($path, '/');
        }
    }
}