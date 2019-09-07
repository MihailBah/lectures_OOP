<?php
/*
Итератор. Подразумевается, что у нас есть набор данных, и есть возможность эти данные обработать по очереди. Если эти данные размещаются по порядку, например, в массиве - ПХП может без проблем по ним пройтисть. Мы вызываем foreach($array as $key => $item) и обрабатываем данные. Но если эти данные размещены в сложной структуре, например, разбросаны по нескольким массивам или хранятся в списке - нам нужно указать по каким правилам эту структуру можно пройти.
Для этого в классе, который представляет структуру - определяются 5 методов:
- current() Указывает на текущий элемент в структуре
- key() Ключ для текущего элемента
- next() Функция, которыя должна переместить указатель на следующий элемент
- rewind() Должна сбросить указатель в исходное положение
- valid() Проверит, можно ли выводить данные, на которые указывает указатель
*/
class MyArray implements Iterator
{
	protected $data = [1, 2, 3];
	protected $index;

	public function current() {
		// var_dump('current called');
		return $this->data[$this->index]; 
	}

	public function key() {
		// var_dump('key called');
		return $this->index;
	}

	public function next() {
		// var_dump('next called');
		$this->index++;
	}

	public function rewind() {
		// var_dump('rewind called');
		$this->index = 0;
	}

	public function valid() {
		// var_dump('valid called');
		return isset($this->data[$this->index]);
	}
}

$obj = new MyArray();
foreach ($obj as $key => $item) {
	var_dump($item);
}
/*
foreach работает по такой схеме:

$obj->rewind();
while($obj->valid()) {
	var_dump($obj->current());
	$obj->next();
}
*/
