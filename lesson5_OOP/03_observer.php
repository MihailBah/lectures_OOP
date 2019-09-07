<?php

/*
Observer (Обозреватель) - паттерн, позволяющий реагировать на события в системе. Состоит из 3-х частей:
EventManager - объект, который узнает о событиях и сообщает о нем тем, кто на это событие подписан.
Подписчик - объект, который будет реагировать на событие (в нашем примере FireDepartment)
Событие - момент, на который должен отреагировать подписчик. (в нашем примере - факт вызова dispatchEvent())

EventManager когда подписывает объект на событие - просто записывает его (объект) в subscribers. Когда событие происходит - EventManager вызовет для всех subscribers метод execute(). Для того, чтобы быть увереным что метод execute будет доступен, в subscribe() указан тип параметра, Executable
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

class EventManager
{
	protected $subscribers;

	public function subscribe(Executable $handler) {
		$this->subscribers[] = $handler;
	}

	public function dispatchEvent($eventData) {
		foreach ($this->subscribers as $subscriber) {
			$subscriber->execute($eventData);
		}
	}
}

$manager = new EventManager();

$fireDepartment1 = new FireDepartment();
//Говорим, что fireDepartment1 должен оповещаться о событиях
$manager->subscribe($fireDepartment1);

$fireDepartment2 = new FireDepartment();
$manager->subscribe($fireDepartment2);

//Генерируем событие. У fireDepartment1 и fireDepartment2 теперь будет вызван execute()
$manager->dispatchEvent([
	'address' => 'SomeAddress'
]);
