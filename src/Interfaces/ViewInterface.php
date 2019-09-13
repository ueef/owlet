<?php

namespace Ueef\Owlet\Interfaces {

    interface ViewInterface
    {
        public function render($views, array $args = [], string $content = null): ?string;
    }
}
