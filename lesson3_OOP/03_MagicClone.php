<?php

/*
clone - операция, которая создает копию объекта. Но если у объекта есть кроме простых типов данных сложные (строки или объекты) - то в новом объекте сохранится ссылка на старые данные
В классе можно определить магический метод __clone. Он будет вызываться когда объект клонируют. Вызываться он будет для нового объекта, т.е. при операции
$mpt1 = clone $mpt;
внутри __clone $this будет указывать на $mpt1.
*/

class MagicPageTest
{
	protected $text;
	public $number;

	public function __construct() {
		$this->text = '';
	}

	public function __clone() {
		//Скажем, что в $mpt1 поле text будет копией огиринального text
		$this->text = clone $this->text;
	}

	public function setText($text) {
		$this->text->data = $text;
	}
}

$mpt = new MagicPageTest();
$mpt->setText('qwer');
$mpt->number = 2;

$mpt1 = clone $mpt;

var_dump($mpt, $mpt1);

echo '<br><br>';
$mpt->setText('a');
$mpt->number = 4;
/*
Если метод __clone() не определен, и в $mpt, и в $mpt1 в поле text будет храниться 'a', т.к. строка хранится отдельно от объекта, и оба объекта ссылаются на одну и ту же строку. При этом, number будет разным, т.к. число является простым типом и хранится прямо в объекте.
*/
var_dump($mpt, $mpt1);





