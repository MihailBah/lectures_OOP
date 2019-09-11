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

class ObjectManager
{
	public function create($className) {
		// $params = [
		// 	'name' => 'a',
		// 	'type' => 'A'
		// ];
		$reflectionMethod = new ReflectionMethod($className, '__construct');
		$params = $reflectionMethod->getParameters();
		$parameter = $params[0];
		$parameterType = (string)$parameter->getType();
		// var_dump($parameterType);die;
		$dependency = new $parameterType();
		var_dump($parameterType, $dependency);die;
		return new $className($dependency);
	}
}

$objectManager = new ObjectManager();

// $a = $objectManager->create('A');
// var_dump($a);
// $b = $objectManager->create('B');
// var_dump($b);
$c = $objectManager->create('C');
var_dump($c);







