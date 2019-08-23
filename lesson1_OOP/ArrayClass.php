<?php

class ArrayClass
{
	private $myArray = [];

	public function addValue($value) {
		$this->myArray[] = $value;
	}
}

$arrayClass = new ArrayClass();
$arrayClass->addValue('qwer');
$arrayClass->addValue('asdf');
$arrayClass->addValue(['qwer', 'asdf']);

$arrayClass2 = new ArrayClass();
$arrayClass2->addValue('zzzzz');

var_dump($arrayClass2->myArray);

