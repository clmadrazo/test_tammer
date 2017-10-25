<?php
 /**  APPLICATION ENVIRONMENTS  *************************************************************************************
 * This block below takes care of loading config files by environment. It relies
 * on a constant (APPLICATION_ENV) that you can set up using the Web Server of
 * your choice. At the moment, we are assuming the following values for that
 * constant: dev, prod and qa.
 * All of this allows us a nice degree of flexibility when managing several
 * environments. For security purposes, we are assuming Production as the
 * default environment. 
 */

/* Available Environments */
define('APPLICATION_ENV_LOCAL', 'local');
define('APPLICATION_ENV_DEV', 'dev');
define('APPLICATION_ENV_PROD', 'prod');

//SET 1  when in development
//define('APP_TESTING_PHASE',1);

/* Current Environment */
defined('APPLICATION_ENV')
    || define(
        'APPLICATION_ENV', 
            (getenv('APPLICATION_ENV') ?
                    getenv('APPLICATION_ENV')
                    : APPLICATION_ENV_LOCAL)
    );
/******************************************************************************************************************/

/**
 * Enable specific config by environment.
 */
$isDevEnvironment = APPLICATION_ENV === APPLICATION_ENV_DEV || APPLICATION_ENV === APPLICATION_ENV_LOCAL;
if ($isDevEnvironment) {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ini_set("display_startup_errors", 1);
} else{
    error_reporting(0);
    ini_set("display_errors", 0);
}

 /**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));
define('APP_PATH', dirname(__DIR__));
define('PUBLIC_PATH', APP_PATH . '/public');

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
