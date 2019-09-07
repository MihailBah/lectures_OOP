<?php
/*
Итератор для двух массивов. Есть объект, который содержит 2 массива. ПХП при обходе такого объекта должен пройти сначала по первому массиву, потом по второму.
*/
class MyArray implements Iterator
{
	//Данные. foreach в должен будет выводить "1 2 3 4 5 6"
	protected $data = [1, 2, 3];
	protected $data2 = [4, 5, 6];
	protected $index;

	public function current() {
		$index = $this->index;
		//Если индекс выходит за рамки первого массива, берем значение из второго
		if ($index >= count($this->data)) {
			$index = $index - count($this->data);
			$value = $this->data2[$index];
		} else {
			$value = $this->data[$index];
		}
		return $value; 
	}

	public function key() {
		//Ключ будет меняться от 0 до 5
		return $this->index;
	}

	public function next() {
		/*
		При переходе на след. элемент увеличиваем индекс на единицу.
		Если здесь поставить $this->index += 2 ПХП начнет выводить элементы через один.
		*/
		$this->index++;

	}

	public function rewind() {
		$this->index = 0;
	}

	public function valid() {
		//Проверяем, что индекс не вышел за рамки обоих массивов. 
		//isset($this->data[$index]), первый массив, не проверяется, т.к. если мы вышли за его рамки - в запасе есть еще второй массив.
		$index = $this->index;
		if ($index >= count($this->data)) {
			$index = $index - count($this->data);
			return isset($this->data2[$index]);
		}
		return true;
	}
}

$obj = new MyArray();
foreach ($obj as $key => $item) {
	var_dump($item);
}
