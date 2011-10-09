<?php
/**
 * CakePHP on fasebook-phpsh
 * 
 * Licensed under The MIT License
 *
 * @link          https://github.com/sizuhiko/taste
 * @see           https://github.com/facebook/phpsh
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class TasteCake {
	function TasteCake() {
		$this->__initConstants();
		$this->__bootstrap();
		Configure::write('App.baseUrl', 'http://localhost');
	}

	function __initConstants() {
		if (function_exists('ini_set')) {
			ini_set('display_errors', '1');
			ini_set('error_reporting', E_ALL & ~E_DEPRECATED);
			ini_set('html_errors', false);
			ini_set('implicit_flush', true);
			ini_set('max_execution_time', 0);
		}

		if (!defined('CAKE_CORE_INCLUDE_PATH')) {
			define('PHP5', (PHP_VERSION >= 5));
			define('DS', DIRECTORY_SEPARATOR);
			define('CAKE_CORE_INCLUDE_PATH', realpath(dirname('taste.php')));
			define('CORE_PATH', CAKE_CORE_INCLUDE_PATH . DS);
			define('DISABLE_DEFAULT_ERROR_HANDLING', false);
			define('CAKEPHP_SHELL', true);
		}
		require_once(CORE_PATH . 'cake' . DS . 'basics.php');
	}

	function __bootstrap() {
		$defaults = array('app' => 'app', 'root' => realpath(dirname('taste.php')), 'working' => null, 'webroot' => 'webroot');

		define('ROOT', $defaults['root']);
		define('APP_DIR', $defaults['app']);
		define('APP_PATH', $defaults['working'] . DS);
		define('WWW_ROOT', APP_PATH . $defaults['webroot'] . DS);
		if (!is_dir(ROOT . DS . APP_DIR . DS . 'tmp')) {
			define('TMP', CORE_PATH . 'cake' . DS . 'console' . DS . 'templates' . DS . 'skel' . DS . 'tmp' . DS);
		}

		$includes = array(
			CORE_PATH . 'cake' . DS . 'config' . DS . 'paths.php',
			CORE_PATH . 'cake' . DS . 'libs' . DS . 'object.php',
			CORE_PATH . 'cake' . DS . 'libs' . DS . 'inflector.php',
			CORE_PATH . 'cake' . DS . 'libs' . DS . 'configure.php',
			CORE_PATH . 'cake' . DS . 'libs' . DS . 'file.php',
			CORE_PATH . 'cake' . DS . 'libs' . DS . 'cache.php',
			CORE_PATH . 'cake' . DS . 'libs' . DS . 'string.php',
			CORE_PATH . 'cake' . DS . 'libs' . DS . 'class_registry.php',
		);

		foreach ($includes as $inc) {
			require($inc);
		}

		Configure::getInstance(file_exists(CONFIGS . 'bootstrap.php'));

    require CAKE . 'dispatcher.php';

		if (!file_exists(APP_PATH . 'config' . DS . 'core.php')) {
			include_once CORE_PATH . 'cake' . DS . 'console' . DS . 'templates' . DS . 'skel' . DS . 'config' . DS . 'core.php';
			App::build();
		}

		return true;
	}
}
$taste = new TasteCake();
