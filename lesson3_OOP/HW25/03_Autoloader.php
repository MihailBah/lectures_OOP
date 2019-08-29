<?php

namespace AppRoot;

function my_loader($class) {
	$path = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
	if (is_file($path)) {
		require_once($path);
	}
}

spl_autoload_register('AppRoot\my_loader');

$customerModel = new Models\Customer();
$productController = new Controllers\Product();

$ns1 = new Controllers\NS1\ClassNS1();

var_dump($ns1);

var_dump($customerModel);
var_dump($productController);
