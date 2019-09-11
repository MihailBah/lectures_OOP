<?php

class A
{}
class B
{}

class ObjectManager
{
	public function create($className) {
		return new $className();
	}
}

$objectManager = new ObjectManager();

$a = $objectManager->create('A');
var_dump($a);
$b = $objectManager->create('B');
var_dump($b);
