<?php

namespace Ueef\Owlet\Interfaces {

    interface EngineInterface
    {
        public function render(ViewInterface $context, $path, &$args, $content = null);
    }
}
