<?php

declare(strict_types=1);

namespace Ueef\Owlet\Interfaces;

interface ViewInterface
{
    public function render($views, array $args, string $content = null): ?string;
}