<?php

/*
Прокси. Используется если есть объекты, создание которых может занять много времени, но эти объекты могут и не понадобиться.
Для примера напишем класс GoogleAPI. Предположим, что в конструкторе он авторизуется в АПИ, и это занимает 3 секунды.
Далее в коде мы можем вызвать у этого объекта predictTemperature(), можем не вызвать. Код будет в обоих случаях выполняться 3 секунды. Для того, чтобы сократить время выполнения в случае, если predictTemperature не понадобится - создаем GoogleAPIProxy. Его конструктор пустой, поэтому выполняется быстро. Сам GoogleAPI будет создаваться только при вызове predictTemperature(). Объектом класса GoogleAPIProxy можно пользоваться так же, как GoogleAPI. GoogleAPIProxy будет просто перенаправлять вызовы методов.
*/

class GoogleAPI
{
	public function __construct() {
		//По-настоящему авторизации нет, вместо нее заглушка. Код будет ничего не делать 3 секунды.
		sleep(3);
	}

	public function predictTemperature() {
		return '+30';
	}
}

class GoogleAPIProxy
{
	protected $instance = null;

	//При вызове predictTemperature проверяем был ли создан объект класса GoogleAPI. Если нет - создаем.
	//Когда GoogleAPI создан = перенаправляем к нему вызов оригинального метода predictTemperature()
	public function predictTemperature() {
		if (!$this->instance) {
			$this->instance = new GoogleAPI();
		}
		return $this->instance->predictTemperature();
	}
}

//При создании GoogleAPIProxy, GoogleAPI еще не создается, поэтому код выполняется быстро.
$googleApi = new GoogleAPIProxy();
//Как только вызываем метод - создается объект GoogleAPI. Эта строка будет выполняться 3 секунды.
echo $googleApi->predictTemperature();
//В этот момент GoogleAPI уже создан, следующая строка выполнится быстро.
echo $googleApi->predictTemperature();
