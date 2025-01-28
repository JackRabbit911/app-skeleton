<?php

date_default_timezone_set(env('APP_TZ'));

define('PRODUCTION', 10);
define('STAGE', 20);
define('TESTING', 30);
define('DEVELOPMENT', 40);

define('ENV', env('APP_ENV'));

// define('IS_DEBUG', (ENV >= TESTING) ? true : false);
// define('IS_CACHE', (ENV >= TESTING) ? false : true);
define('DISPLAY_ERRORS', (ENV >= TESTING) ? true : false);

define('IS_DEBUG', false);
define('IS_CACHE', false);

/** for Image module */
define('IS_FOREIGN', false);
define('IS_WATERMARK', true);
define('IS_IMG_CACHE', false);

define('STRICT_MODE', false);

if (PHP_SAPI === 'cli') {
    define('MODE', 'cli');
} elseif (strpos($_SERVER['REQUEST_URI'], '/api/') === 0) {
    define('MODE', 'api');
} else {
    define('MODE', 'web');
}

define('ROUTE_PATHS', [
    CONFIG . 'simple_routes/' . MODE . '.php',
    APPPATH . 'auth/config/simple_routes.php',
    CONFIG . 'simple_routes/common.php',
]); 
