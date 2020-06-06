<?php
define('PROJECT_ROOT', '/var/www/html');

spl_autoload_register(function ($className){
	$file = PROJECT_ROOT . "/classes/$className.php";
	if (is_file($file)) {
		require $file;
		return;
	}
	throw new \Exception("File $file not found for classes $className");
});