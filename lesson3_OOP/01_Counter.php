<?php
/*
Класс, у которого нельзя создать больше 5-ти объектов.
Во-первых, убираем конструктор из публичного доступа, помечаем его protected.
Во-вторых, создаем статический метод, который будет создавать объекты и контролировать их количество. Когда self::$counter становится равен 5, Counter::getInstance() начинает возвращать null
*/

class Counter
{
	static protected $counter;

	protected function __construct() {
		//
	}

	public static function getInstance() {
		if (self::$counter++ < 5) {
			return new Counter();
		}
	}
}

$c1 = Counter::getInstance();//object(Counter)
$c2 = Counter::getInstance();//object(Counter)
$c3 = Counter::getInstance();//object(Counter)
$c4 = Counter::getInstance();//object(Counter)
$c5 = Counter::getInstance();//object(Counter)
$c6 = Counter::getInstance();//null
$c7 = Counter::getInstance();//null
$c8 = Counter::getInstance();//null
$c9 = Counter::getInstance();//null
var_dump($c9);
