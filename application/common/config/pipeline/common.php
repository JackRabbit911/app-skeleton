<?php

use Az\Route\Middleware\RouteDispatchMiddleware;
use Az\Route\Middleware\RouteMatchMiddleware;
use Az\Route\Middleware\RouteMiddleware;
use Common\Middleware\RouterBootstrap;

$this->pipe(RouterBootstrap::class);
$this->pipe(RouteMatchMiddleware::class);
$this->pipe(RouteMiddleware::class);
$this->pipe(RouteDispatchMiddleware::class);
