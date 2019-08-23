<?php

class Transport
{
	public function start() {
		//
	}
}

class Vehicle extends Transport
{
	public function start() {
		//запустить двигатель
		//включить передачу
		//нажать на газ
		echo 'Starting Vehicle<br>';
	}
}

class Boat extends Transport
{
	public function start() {
		//сняться с причала
		//поднять паруса
		echo 'Starting Boat<br>';
	}
}

$transports = [
	new Vehicle(),
	new Vehicle(),
	new Boat()
];

foreach ($transports as $transport) {
	$transport->start();
}
