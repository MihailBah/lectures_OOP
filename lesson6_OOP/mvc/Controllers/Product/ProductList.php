<?php

require_once('Models/ProductModel.php');

class ProductList 
{
	//Для работы этого класса нужна ProductModel, т.к. она будет тащить информацию из базы. ProductModel таким образом, является зависимостью ProductList. Зависимости принято объявлять в конструкторе.
	public function __construct() {
		//ProductModel подключена в Models/ProductModel.php. Этот файл в свою очередь подключает Models/DbConnection.php, в котором объявлен Connection
		$this->productModel = new ProductModel(Connection::getInstance());
	}

	public function execute() {
		/*
		При запросе product/productlist код из index.php вызовет эту функцию.
		Функция должна будет запросить данные из базы, через $this->productModel, результат сохранить в $products
		*/
		var_dump('ProductList execute');

		// $products = $this->productModel->listAll();
		$products = [
			[
				'name' => 'iphone',
				'price' => 400
			],
			[
				'name' => 'samsung',
				'price' => 350
			]
		];
		/*
		После того, как данные получены - выводим их на экран. Подключаем файл Views/productlist.html (это наш View) - ему будут доступны все переменные из функции. Внутри во View будет проход по всем продуктам и вывод их на экран в виде таблицы
		*/
		include('Views/productlist.html');

	}
}