<?php

class A
{
	public $value = 5;
	private static $counter = 0;

	public function __construct() {
		// A::$counter++;
		self::$counter++;
	}

	public function getObjectsNumber() {
		return self::$counter;
	}

	public static function getObjectsNumberStatic() {
		return self::$counter;
	}
}

class B extends A {}

$a = new B();
$b = new B();
$c = new A();

echo $c->getObjectsNumber();
echo A::getObjectsNumberStatic();
echo B::getObjectsNumberStatic();
