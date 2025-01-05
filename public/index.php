<?php

$GLOBALS['_start'] = hrtime(true);
$GLOBALS['_ram'] = memory_get_usage();

// define('MAINFOLDER', basename(__DIR__) . '/');
define('DOCROOT', './');
define('ROOTPATH', '../../');
define('SYSPATH', '../');
define('FRAMEWORK', SYSPATH . 'vendor/alpha-zeta/framework/src/');
define('APPPATH', '../application/');
define('STORAGE', '../storage/');
define('CONFIG', APPPATH . 'common/config/');
define('ENVPATH', '../');

// var_dump(is_dir(APPPATH));
// exit;

require_once SYSPATH . 'vendor/autoload.php';
require_once FRAMEWORK . 'autoload.php';
require_once FRAMEWORK . 'library.php';
require_once CONFIG . 'bootstrap.php';

date_default_timezone_set(env('APP_TZ'));

$mode = getMode(CONFIG . 'mode.php');

$container = (new Sys\ContainerFactory($mode))->create(new DI\ContainerBuilder());
$app = $container->get(Sys\App::class);
$app->run();
