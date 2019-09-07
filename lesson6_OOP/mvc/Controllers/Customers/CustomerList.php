<?php

/*
Еще один контроллер. Так же как ProductList, он будет вытаскивать информацию из базы, только теперь для отображения данных нужно будет использовать Твиг.
Для того чтобы контроллер не показывал ошибку, нужно подключить пакет twig через composer, и подключть его автолоадер (require_once('vendor/autoload.php'))
*/

class CustomerList 
{
	public function __construct() {
		$loader = new \Twig\Loader\FilesystemLoader('Views');
		$twig = new \Twig\Environment($loader);
	}


	public function execute() {
		var_dump('CustomerList execute');
	}
}