<?php

/*
Пример вложенности объектов. Объект $st1 класса TestClass содержит поле data, в которое потом записываем объект $textObject класса Text
*/

class Text
{
	public $text;
	public $anotherText;

	public function sayHello() {}
}

class TestClass
{
	public $data;
}

$st1 = new TestClass();

$textObject = new Text();
$textObject->text = 'qwer';
$st1->data = $textObject;
//Равно что $st1->data->text = 'qwer';

var_dump($textObject, $st1);

$obj = $st1->data;
$obj->text;

$st1->data->sayHello();

