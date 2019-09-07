<?php

/*
MVC - паттерн, позволяющий разделить приложение на структурные части. Предусмитривает три вида компонентов:

Model - представляют данные, делают запросы в базу.
View - Выводят данные на экран, в виде html
Controller - реагируют на запросы.

Запрос при этом строится таким образом:
http://localhost/mvc/<controller>/<action>
где <controller> и <action> - название контроллера, который будет выполняться. 
Наше приложение при таком запросе будет искать файл контроллера по адресу Controllers/<controller>/<action>.php
(http://localhost/mvc/products/productlist вызовет файл Controllers/products/productlist.php). Контроллер в свою очередь должен будет получить данные из модели, передать во вью, и выдать пользователю результат.

Чтобы все это заработало, первым делом нужно сконфигурировать веб-сервер, чтобы он всегда отправлял пользователя на index.php и параметром передавал УРЛ, который запросил пользователь
http://localhost/mvc/products/productlist
должен будет принять такой вид
http://localhost/mvc/index.php?url=products/productlist
Эта настройка задается в .htaccess для apache. Для nginx можно поискать по запросу "Настройка nginx для MVC"

ЕСЛИ НЕ ПОЛУЧИТСЯ НАСТРОИТЬ ВЕБ-СЕРВЕР
Ничего страшного, можно делать запрос сразу в преобразованном виде:
http://localhost/mvc/index.php?url=products/productlist
Это никак не повлияет на понимание концепции MVC
*/

//Запрос
//product/productlist

//Считываем запрос, разбиваем на части для последующего анализа
$request = $_GET['url'];
$requestParts = explode('/', $request);
$path = 'Controllers/' . $request . '.php';

//Получили адрес файла контроллера, проверяем существует ли такой. Если нет - показываем пользователю ошибку 404. Если есть - подключаем файл, запускаем контроллер методом execute()
if (is_file($path)) {
	require_once($path);
	$controllerName = $requestParts[1];
	// var_dump($controllerName);
	$controllerName = ucfirst($controllerName);
	// var_dump($controllerName);
	$controller = new $controllerName();

	$controller->execute();
} else {
	//redirect to 404
	echo '404';
}

