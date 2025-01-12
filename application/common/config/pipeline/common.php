<?php

use Az\Route\Middleware\RouteDispatch;
use Az\Route\Middleware\RouteMatch;

$this->pipe(RouteMatch::class);
$this->pipe(RouteDispatch::class);
