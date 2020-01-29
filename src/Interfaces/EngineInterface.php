<?php

declare(strict_types=1);

namespace Ueef\Owlet\Interfaces;

interface EngineInterface
{
    public function render(ViewInterface $context, string $path, array &$args, ?string $content = null): ?string;
}
