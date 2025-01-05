<?php declare(strict_types=1);

namespace Common\Middleware;

use Az\Route\RouterInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class RouterBootstrap implements MiddlewareInterface
{
    private RouterInterface $route;

    public function __construct(RouterInterface $route)
    {
        $this->route = $route;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $mode = getMode();

        // $file = CONFIG . "simple_routes/common.php";
        // if ($file && is_file($file)) {
        //     $this->route->routes(require_once $file);
        // }

        
        // $file = CONFIG . "simple_routes/$mode.php";
        // if ($file && is_file($file)) {
        //     $this->route->routes(require_once $file);
        // }
        
        // $file = APPPATH . 'auth/config/simple_routes.php';
        // if ($file && is_file($file)) {
        //     $this->route->routes(require_once $file);
        // }

        $file = CONFIG . "routes/common.php";
        if ($file && is_file($file)) {
            require_once $file;
        }

        $file = CONFIG . "routes/$mode.php";
        if (is_file($file)) {
            require_once $file;
        }
        
        return $handler->handle($request);
    }
}
