<?php
define('REQUEST_START', microtime(true));
define('APP_DIR', dirname(__DIR__));

chdir(APP_DIR);

// composer autoloading
if (file_exists(APP_DIR.'/vendor/autoload.php')) {
	$loader = include APP_DIR.'/vendor/autoload.php';
}
// support for VIVO_DIR environment variable
if (($vivo_home = getenv('VIVO_HOME')) && is_dir($vivo_home)) {
	if (isset($loader)) {
		$loader->add('', $vivo_home.'/src');
	}
}
if (!class_exists('Vivo\Application')) {
	trigger_error('Unable to load Vivo. Run `composer install` or define a VIVO_HOME environment variable pointing to existing vivo directory.', E_USER_ERROR);
} else {
	$app = new Vivo\Application();
	$app->run();
}
