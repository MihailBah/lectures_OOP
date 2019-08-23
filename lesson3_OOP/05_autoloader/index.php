<?php
/*
В ПХП у нас есть возможность подгружать файлы с классами автомагически, с помощью функций-автозагрузчиков. Если в скрипте попытаться сослаться на класс, которого в системе нет - ПХП будет вызывать автозагрузчики в надежде что они подтянут нужный класс.
Для того, чтобы этим воспользоваться, нужно во-первых зарегистрировать свой автозагрузчик функцией 
spl_autoload_register('my_loader');
И потом определить собственно функцию my_loader.
В my_loader параметром будет попадать название запрошенного класса. Функция должна подключить тот файл, где этот класс определен.
*/

// require_once('classes/Ninja.php');
//OR
function my_loader($class_name) {
	var_dump($class_name);
	//Смотрим какие файлы есть у нас в папке classes
	foreach(scandir('classes') as $file) {
		//Если название файла содержит слово Ninja = подключаем его
		if (strstr($file, 'Ninja')) {
			require_once('classes/' . $file);
		}
	}
}
spl_autoload_register('my_loader');

$ninja = new Ninja();

var_dump($ninja);



$obj = new NS1\NS2\MyClass();
//в файле classes/NS1/NS2/MyClass.php
var_dump($obj);



