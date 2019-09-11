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

class ObjectManager
{
	public function create($className) {
		// $params = [
		// 	'name' => 'a',
		// 	'type' => 'A'
		// ];
		$reflectionMethod = new ReflectionMethod($className, '__construct');
		$params = $reflectionMethod->getParameters();

		$dependencies = [];
		foreach ($params as $parameter) {
			$parameterType = (string)$parameter->getType();
			$dependencies[] = new $parameterType();
		}
		// var_dump($dependencies);die;

		return new $className(...$dependencies);
	}
}

$objectManager = new ObjectManager();

// $a = $objectManager->create('A');
// var_dump($a);
// $b = $objectManager->create('B');
// var_dump($b);
// $c = $objectManager->create('C');
// var_dump($c);
$d = $objectManager->create('D');
var_dump($d);







