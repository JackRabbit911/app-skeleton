<?php

use HttpSoft\Runner\MiddlewarePipelineInterface;
use HttpSoft\Runner\MiddlewarePipeline;
use HttpSoft\Runner\MiddlewareResolver;
use HttpSoft\Runner\MiddlewareResolverInterface;
use HttpSoft\ServerRequest\ServerRequestCreator;
use HttpSoft\Emitter\EmitterInterface;
use HttpSoft\Emitter\SapiEmitter;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
// use Az\Route\RouteCollectionInterface;
use Az\Route\RouteCollection;
use Az\Route\Matcher;
use Az\Route\RouteFactory;
use Az\Route\Router;
use Az\Route\RouterInterface;
use Sys\Exception\SetErrorHandlerInterface;
use Sys\Exception\WhoopsAdapter;
use Sys\DefaultHandler;
// use Sys\MiddlewareResolver;
use Sys\Exception\ExceptionResponseFactory;
use Pecee\Pixie\Connection;
use Pecee\Pixie\QueryBuilder\QueryBuilderHandler;
use Az\Session\Session;
use Az\Session\Driver;
use Az\Session\SessionInterface;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Psr\Http\Server\RequestHandlerInterface;
use Sys\Profiler\Model\Mysql;
use Sys\Profiler\Model\ProfilerModelInterface;
use Sys\Profiler\Profiler;

return [
    ServerRequestInterface::class => fn() => (new ServerRequestCreator())->create(),
    RequestHandlerInterface::class => fn(ExceptionResponseFactory $factory) => new DefaultHandler($factory),
    RouterInterface::class => fn(ServerRequestInterface $request) => new RouteCollection($request),
    // RouterInterface::class => fn(ContainerInterface $c) => new Router($c->get(Matcher::class), $c->get(RouteFactory::class)),
    MiddlewarePipelineInterface::class => fn() => new MiddlewarePipeline(),
    MiddlewareResolverInterface::class => fn(ContainerInterface $c) => new MiddlewareResolver($c),
    EmitterInterface::class => fn() => new SapiEmitter,
    LoggerInterface::class => function () {
        $logger = new Logger('e');
        $logger->setTimezone(new \DateTimeZone(env('APP_TZ')));
        $logger->pushHandler(new StreamHandler(STORAGE . 'logs/error.log', Level::Error, true, 0777));
        return $logger;
    },
    'logger' => function ($name, $file, $level) {
        $logger = new Logger($name);
        $logger->setTimezone(new \DateTimeZone(env('APP_TZ')));
        $logger->pushHandler(new StreamHandler(STORAGE . 'logs/' . $file, $level, true, 0777));
        return $logger;
    },
    SetErrorHandlerInterface::class => fn(ServerRequestInterface $request, 
        LoggerInterface $logger, 
        EmitterInterface $emitter, 
        ExceptionResponseFactory $response_factory) 
        => new WhoopsAdapter($request, $logger, $emitter, $response_factory),
    
    QueryBuilderHandler::class => fn() => (new Connection('mysql', config('database', 'connect.mysql')))->getQueryBuilder(),
    
    SessionInterface::class => function (ContainerInterface $c) {
        switch (env('SESSION_DRIVER')) {
            case 'DB':
                $qb = $c->get(QueryBuilderHandler::class);
                $handler = new Driver\Db($qb->pdo());
                break;
            default:
                $handler = null;
        }

        return new Session(config('session'), $handler);
    },
    
    // ProfilerModelInterface::class => fn(ContainerInterface $c) => $c->get(Mysql::class),
    // Profiler::class => fn(ContainerInterface $c)
    //     => new Profiler($c->get(ProfilerModelInterface::class), $c->get(RouteCollectionInterface::class)),
];