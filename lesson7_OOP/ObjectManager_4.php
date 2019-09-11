<?php

class A
{}
class B
{}
class C
{
	public function __construct(A $a) {
		var_dump($a);
	}
}
class D
{
	public function __construct(A $a, B $b) {
		var_dump($a, $b);
	}
}
class E
{
	public function __construct(C $c) {
		var_dump($c);
	}
}

class ObjectManager
{
	public function create($className) {
		// $params = [
		// 	'name' => 'a',
		// 	'type' => 'A'
		// ];
		$dependencies = [];
		if (method_exists($className, '__construct')) {
			$reflectionMethod = new ReflectionMethod($className, '__construct');
			$params = $reflectionMethod->getParameters();

			foreach ($params as $parameter) {
				$parameterType = (string)$parameter->getType();
				// $dependencies[] = new $parameterType();
				$dependencies[] = $this->create($parameterType);
			}
			// var_dump($dependencies);die;
		}

		return new $className(...$dependencies);
	}
}

$objectManager = new ObjectManager();

$a = $objectManager->create('A');
var_dump($a);
$b = $objectManager->create('B');
var_dump($b);
$c = $objectManager->create('C');
var_dump($c);
$d = $objectManager->create('D');
var_dump($d);
$e = $objectManager->create('E');
var_dump($e);







