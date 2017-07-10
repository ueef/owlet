<?php

namespace Ueef\Owlet\Interfaces {

    interface EngineInterface
    {
        public function render(ViewInterface $context, $path, array &$args, ?string $content = null): string;
    }
}
