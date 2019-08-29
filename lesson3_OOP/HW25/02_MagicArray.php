<?php

class MagicArray
{
	protected $_data = [];

	public function __call($method, $args) {
		if(strpos($method, 'get') === 0) {
			$key = substr($method, strlen('get'));

			// return isset($this->_data[$key]) ? $this->_data[$key] : null;
			return $this->_data[$key] ?? null;

		} else if(strpos($method, 'set') === 0) {
			$key = substr($method, strlen('set'));
			$this->_data[$key] = $args[0];
		} else if(strpos($method, 'has') === 0) {
			$key = substr($method, strlen('has'));
			return isset($this->_data[$key]);
		}
	}

	public function getData() {
		return $this->_data;
	}
}

$ma = new MagicArray();

$ma->setColor('green');
$ma->setWeight(10);
var_dump($ma->getColor());//Выведет green
var_dump($ma->getTaste());//Выведет null

var_dump($ma->hasColor());//Выведет true
var_dump($ma->hasTaste());//Выведет false

//Особый метод, выводит информацию о всех данных
print_r($ma->getData());
//Выведет:
/*
[
	'color' => 'green',
	'weight' => 10
]
*/