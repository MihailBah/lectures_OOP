<?php
/*
Пространства имен (namespace) - это дополнение к названию класса. Например, в системе может быть зарегистрировано два класса Table. Но полное название первого будет, скажем:
\Parsers\Csv\Table
название второго:
\Google\Spreadsheet\Table
Можно было бы название класса делать больше, например:
class Parsers_Csv_Table
class Google_Spreadsheet_Table
Так до сих пор делают в некоторых системах, но в более новых используются преимущественно неймспейсы.

В ПХП всегда есть глобальный неймспейс, в нем определны стандартные функции и классы, и в нем будут храниться функции и классы из файлов, где неймспейс не указан. Обратиться к глобальному неймспейсу можно через бекслеш (\) 

У пространств имен есть некоторые свойства:
- один файл может принадлежать одному пространству имен. Неймспейс должен быть определет в начале файла первой строкой.
- внутри пространства имен можно переопределить любые сущности, включая стандартные функции ПХП, например print_r
- пространства имен могут быть вложенными (\MyLibrary\ns2\ - говорит что ns2 находится внутри MyLibrary). Обращаясь к классу, можно указывать либо полный адрес, начиная с глобального неймспейса, либо относительный. Относительный - имеется в виду относительно того неймспейса, в котором находится файл. 
Мы сейчас в MyLibrary, так что к \MyLibrary\ns2\print_r можно обратиться просто ns2\print_r (обратите внимание, самый первый бекслеш я убрал).
*/
namespace MyLibrary;

require_once('ns1.php');
require_once('ns2.php');

function print_r($arr) {
	echo 'print r!<br>';
}

$array  = [1,2,3];
print_r($array);//Мы сейчас находимся в \MyLibrary, будет вызван \MyLibrary\print_r
\ns1\print_r($array);
\MyLibrary\ns2\print_r($array);//Вызываем функцию из вложенного неймспейса через полный путь
ns2\print_r($array);//Вызываем ту же функцию из вложенного неймспейса, только  через относительный путь
\print_r($array);//Стандартный print_r ПХП, из глобального неймспейса