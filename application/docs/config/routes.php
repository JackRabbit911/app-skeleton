<?php declare(strict_types = 1);

use Docs\Guide\Controller\Guide;
use Sys\Controller\Media;

return [
    'media' => ['/media/{lifetime}/{file}', [Media::class, 'process'], ['lifetime' => '\d*', 'file' => '.*']],
    'guide' => ['/guide/{folder}/{file}', Guide::class, ['folder' => '[-\w]+', 'file' => '[-\.\w]+']],
];
