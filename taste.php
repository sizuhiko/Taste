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
		
		App::uses('ClassRegistry', 'Utility');
		App::uses('Dispatcher', 'Routing');
		App::uses('Router', 'Routing');
		Configure::write('App.baseUrl', 'http://localhost');
	}

	function __initConstants() {
		if (function_exists('ini_set')) {
			ini_set('html_errors', false);
			ini_set('implicit_flush', true);
			ini_set('max_execution_time', 0);
		}

		if (!defined('CAKE_CORE_INCLUDE_PATH')) {
			define('DS', DIRECTORY_SEPARATOR);
			define('ROOT', realpath(dirname('taste.php')));
			define('CAKE_CORE_INCLUDE_PATH', ROOT . DS . 'lib');
			define('CAKEPHP_SHELL', true);
			if (!defined('CORE_PATH')) {
				define('CORE_PATH', CAKE_CORE_INCLUDE_PATH . DS);
			}
		}
	}

	function __bootstrap() {
		$defaults = array('app' => 'app', 'root' => ROOT, 'working' => null, 'webroot' => 'webroot');

		define('APP_DIR', $defaults['app']);
		define('APP_PATH', $defaults['working'] . DS);
		define('WWW_ROOT', APP_PATH . $defaults['webroot'] . DS);
		if (!is_dir(ROOT . DS . APP_DIR . DS . 'tmp')) {
			define('TMP', CAKE_CORE_INCLUDE_PATH . DS . 'Cake' . DS . 'Console' . DS . 'Templates' . DS . 'skel' . DS . 'tmp' . DS);
		}

		$boot = file_exists(ROOT . DS . APP_DIR . DS . 'Config' . DS . 'bootstrap.php');
		require CORE_PATH . 'Cake' . DS . 'bootstrap.php';

		if (!file_exists(APP . 'Config' . DS . 'core.php')) {
			include_once CAKE_CORE_INCLUDE_PATH . DS . 'Cake' . DS . 'Console' . DS . 'Templates' . DS . 'skel' . DS . 'Config' . DS . 'core.php';
			App::build();
		}

		if (!defined('FULL_BASE_URL')) {
			define('FULL_BASE_URL', 'http://localhost');
		}

		return true;
	}
}
$taste = new TasteCake();
