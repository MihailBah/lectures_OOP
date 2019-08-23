<?php
/*
Рефлексия - инструмент, который позволяет получить информацию о классе и его методах.
В нашем курсе это будет использоваться для построения "умного автозагрузчика" - который будет автоматом подтягивать зависимости подключаемого класса.
Для наших целей нужно будеть быть знакомым с ReflectionMethod - смотреть какие параметры принимает метод, их названия и тип.
*/
class SomeClass
{}

class ReflectionTest
{
	public function foo(array $data) {
		var_dump($data);
	}
	
	public function bar(SomeClass $someClass) {
		var_dump($someClass);
	}
}

$reflectionClass = new ReflectionClass(ReflectionTest::class);
var_dump($reflectionClass->getMethods());

$reflectionMethod = new ReflectionMethod(ReflectionTest::class, 'bar');
/*
Покажет, что метод 'bar' из ReflectionTest принимает один параметр типа SomeClass, и называется параметр $someClass
*/
$parameters = $reflectionMethod->getParameters();
var_dump((string)$parameters[0]->getType());
