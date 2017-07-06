<?php

namespace Ueef\Owlet\Interfaces {

    interface ViewInterface
    {
        public function render(array $paths, array $args, string $content = null): string;
    }
}
