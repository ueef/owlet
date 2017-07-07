<?php

namespace Ueef\Owlet\Interfaces {

    interface ViewInterface
    {
        public function render(array $views, array $args, string $content = null): string;
    }
}
