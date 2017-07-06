<?php

use Ueef\Owlet\View;

require '../vendor/autoload.php';

$view = new View([
    '/1',
    [
        '/1',
        '/2',
    ],
    [
        '/1',
        '/2',
        '/3',
        [
            '/1',
            '/2',
            '/3',
            '/4',
        ],
    ],
]);