<?php

/*
В прошлом примере, для каждого нового метода в GoogleAPI нужно создавать соответствующий метод в GoogleAPIProxy. Если  добавим в GoogleAPI predictWeather() - в GoogleAPIProxy нужно будет создать такой же метод, который проверит был ли создан объект GoogleAPI и перенаправим в него вызов. 
На самом деле, код GoogleAPIProxy будет одинаков для всех методов, так что можно его упростить с помощью магического метода __call
*/

class GoogleAPI
{
	public function __construct() {
		//Authorization
		sleep(3);
	}

	public function predictTemperature() {
		return '+30';
	}

	public function predictWeather() {
		return 'rainy';
	}
}

class GoogleAPIProxy
{
	protected $instance = null;

	//При вызове любого метода в GoogleAPIProxy будем проверять создан ли объект GoogleAPI, и когда он создан - перенаправим к нему вызов метода.
	public function __call($method, $args) {
		if (!$this->instance) {
			$this->instance = new GoogleAPI();
		}
		return $this->instance->$method(...$args);
	}
}

$googleApi = new GoogleAPIProxy();
echo $googleApi->predictTemperature();
echo $googleApi->predictWeather();
