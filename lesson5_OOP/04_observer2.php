<?php

/*
Добавляем обозревателю разные типы собитий. От первого примера отличается только тем, что subscribers становится двумерным массивом. Теперь он кроме подписчиков будет хранить тип события, на которое подписчик должен реагировать. subscribers будет в таком виде:
"тип события" => "массив подписчиков на это событие"
или:

'injury' => [
	$hospital1,
	$hospital2,
	...
],
'fire' => [
	$fireDepartment1,
	$fireDepartment2,
	...
];

*/

interface Executable
{
	public function execute($eventData);
}

class FireDepartment implements Executable
{
	public function execute($eventData) {
		echo 'FireDept goes to ' . $eventData['address'] . '<br>';
	}
}

class Hospital implements Executable
{
	public function execute($eventData) {
		echo 'Hospital goes to ' . $eventData['address'] . '<br>';
	}
}

class EventManager
{
	protected $subscribers;
	
//Метод теперь кроме самого подписчика будет принимать тип события для этого подписчика.
	public function subscribe(Executable $handler, $type) {
		if (empty($this->subscribers[$type])) {
			$this->subscribers[$type] = [];
		}
		$this->subscribers[$type][] = $handler;

		// var_dump($this->subscribers);
	}

	//$this->subscribers[$type] хранит всех подписчиков на событие $type
	public function dispatchEvent($eventData, $type) {
		foreach ($this->subscribers[$type] as $subscriber) {
			$subscriber->execute($eventData);
		}
	}
}

$manager = new EventManager();

$fireDepartment1 = new FireDepartment();
//Подписываем fireDepartment1 на событие fire
/*
$subscribers теперь выглядит так:
[
	'fire' => [
		$fireDepartment1
	]
]
*/
$manager->subscribe($fireDepartment1, 'fire');

$fireDepartment2 = new FireDepartment();
//Подписываем fireDepartment2 на то же событие
/*
$subscribers теперь будет таким:
[
	'fire' => [
		$fireDepartment1,
		$fireDepartment2
	]
]
*/
$manager->subscribe($fireDepartment2, 'fire');

$manager->dispatchEvent([
	'address' => 'SomeAddress'
], 'fire');


$hospital1 = new Hospital();
//Подписываем hospital1 на другой тип события, injury
/*
$subscribers становится таким:
[
	'fire' => [
		$fireDepartment1,
		$fireDepartment2
	],
	'injury' => [
		$hospital1
	]
]
*/
$manager->subscribe($hospital1, 'injury');
$manager->dispatchEvent([
	'address' => 'SomeAddress'
], 'injury');
