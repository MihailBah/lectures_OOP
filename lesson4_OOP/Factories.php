<?php

class Enemy
{
	public $damage;
	public $health;

	public function __construct($damage, $health) {
		$this->damage = $damage;
		$this->health = $health;
	}
}
/*
Фабрика, которой не важно какой класс создавать. Название класса передается в конструкторе.
*/
class AbstractFactory
{
	protected $className;
	public function __construct($className) {
		$this->className = $className;
	}

	public function create() {
		$args = func_get_args();
		// var_dump($args);die;

		/*
		Две строки ниже эквивалентны. Вызываем функцию, отправляем в нее те же параметры, с которыми был вызван create(). Запись ...$args будет работать с любым числом параметров.
		*/
		// return new $this->className($args[0], $args[1]);
		return new $this->className(...$args);
		/*
		Названия функций, классов и переменных могут храниться в переменных. Т.е. я могу записать:

		$myVar = 5;
		$varName = 'myVar';
		$$varName = 6;

		После этого в $myVar будет храниться 6, так как $$varName равно что $myVar. Таким же образом я могу хранить название класса:

		$clsssName = 'Enemy';
		$enemyObj = new $className();
		*/
	}
}

$factory1 = new AbstractFactory('Enemy');
$enemy1 = $factory1->create(10, 50);
var_dump($enemy1);
