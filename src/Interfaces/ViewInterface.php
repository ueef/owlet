<?php

namespace Ueef\Owlet\Interfaces {

    interface ViewInterface
    {
        /**
         * @param $views
         * @param array $args
         * @param null $content
         * @return string
         */
        public function render($views, array $args = [], $content = null);
    }
}
