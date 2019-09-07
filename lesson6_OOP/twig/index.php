<?php

/*
Пример использования шаблонизатора Twig
Шаблонизатор становится доступным после установки через композер. В корне проекта нужно вызвать 
composer require "twig/twig:^2.0"
Твиг скачается автоматически, в проекте появится папка vendor, в ней помимо прочего будет autoload.php - этот файл нужно подключить.

Дополнительная информация доступна по адресу
https://twig.symfony.com/doc/2.x/
Наиболее полезные статьи - по использованию на фронте
https://twig.symfony.com/doc/2.x/templates.html
и на беке
https://twig.symfony.com/doc/2.x/api.html

По желанию можно добавить собственный фильтр
https://twig.symfony.com/doc/2.x/advanced.html (раздел Filters)
Его можно будет использовать на фронте через символ "|", так же как {{item | upper}}
*/

require_once 'vendor/autoload.php';

/*
Когда автолоадер подключен, нужно получить объект шаблонизатора ($twig) - ему нужно сообщить где можно будет брать шаблоны (в нашем случае - это файловая система, папка 'templates')
*/

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);
/*
Когда объект шаблонизатора подключен, можно вызвать отрисовку шаблона. Ниже мы говорим, что нужно подключить файл templates/index.php, и отрисовать его с параметрами $params. В шаблоне будут доступны переменные 'varname' и 'some_array', которые будут выводиться либо в сыром виде ({{ varname }}), либо через foreach (в синтаксисе твига это выглядет как {% for item in some_array %})
*/
$template = $twig->load('index.html');
$params = [
	'varname' => 'The value',
	'some_array' => [
		'val1',
		'val2',
		'val3'
	]
];
echo $template->render($params);
