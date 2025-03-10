<?php declare(strict_types = 1);

use Sys\I18n\Enum\DetectionMethod;
use Sys\I18n\Enum\Redirect;

return [
    'langs' => ['en' => 'English', 'ru' => 'Русский', 'de' => 'Deutsch'],
    'detectionMethod' => DetectionMethod::Segment,
    'redirect' => Redirect::Lang2empty,
    'index' => 0, //Position of the segment in uri or subdomain in host
];
