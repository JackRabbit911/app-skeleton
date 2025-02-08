<?php

use App\Controller\Home;
use HttpSoft\Response\HtmlResponse;

return [
    // 'home'      => ['/', fn() => new HtmlResponse('It works!')],
    'home'      => ['/', Home::class],
];
