<?php

namespace Ueef\Owlet\Interfaces {

    interface EngineInterface
    {
        public function render(ViewInterface $context, $path, array &$args, string $content = ''): callable;
        public function exists(string $path): bool;
    }
}
