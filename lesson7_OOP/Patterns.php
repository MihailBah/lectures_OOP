<?php

/*
Полиморфизм. Одинаковый метод выполняется по-разному в разных классах.
Для восстановления создать один или несколько классов, которые наследуют более абстрактный, и переопределить метод абстрактного класса.
*/

class A {
	public function doSomething() {
		$this->beforeDoSomething();
		echo 'something';
	}

	public function beforeDoSomething() {}
}

class B extends A
{
	public function beforeDoSomething() {
		echo 'Before doing';
	}
}

$a = new A();
$a->doSomething();
$b = new B();
$b->doSomething();

/*
Фабрика. Служит для создания объектов.
Для восстановления создать класс с методом create(), который будет создавать объекты
*/

class A
{
	//
}
class AFactory
{
	public function create() {
		return new A();
	}
}
$aFactory = new AFactory();
$a = $aFactory->create();
var_dump($a);

/*
Синглтон. Класс, который может существовать в системе в единственном экземпляре.
Для восстановления:
- Пометить конструктор приватным
- Определить статическую переменную для хранения экземпляра класса
- Написать метод для получения (или создания) этого экземпляра
*/

class SingletoneExample
{
	public $data;
	
	protected static $instance;
	private function __construct(){}

	public static function getInstance() {
		if (!self::$instance) {
			self::$instance = new SingletoneExample();
		}
		return self::$instance;
	}
}

$a = SingletoneExample::getInstance();
$a->data = 5;
$b = SingletoneExample::getInstance();
var_dump($b->data);

/*
Прокси. Создает экземпляр класса только если этот экземпляр используется (у него вызывается какой-то метод)
Для восстановления:
- Создать целевой класс, для которого будет прокси
- Создать сам прокси, прописать в нем те же методы, что и в целевом классе
- В прокси, прописать логику которая будет при вызове любого метода создавать целевой класс и перенаправлять к нему вызов. 
*/

class Product
{
	public function __construct() {
		sleep(2);
	}

	public function getPrice() {
		return 25;
	}
}

class ProductProxy
{
	protected $instance;
	
	public function getPrice() {
		if (!$this->instance) {
			$this->instance = new Product();
		}
		return $this->instance->getPrice();
	}
}
$product = new ProductProxy();
//До этой строки код доходит быстро
$price = $product->getPrice();
//Здесь создается экземпляр класса, команда выполняется долго
$price = $product->getPrice();
//В этот момент экземпляр уже создан, строка выполняется быстро


/*
Обозреватель. Служит для опвещения системы о событиях.
Для восстановления:
- Создать класс, который будет принимать и распространять события
- Добавить возможность подписаться на событие и оповестить о нем
*/

class Observer
{
	public function execute($eventData) {
		echo 'executing!!';
	}
}

class EventManager
{
	protected $subscribers;

	public function subscribe(Observer $handler) {
		$this->subscribers[] = $handler;
	}

	public function dispatch($eventData) {
		foreach ($this->subscribers as $subscriber) {
			$subscriber->execute($eventData);
		}
	}
}

$eventManager = new EventManager();
$observer = new Observer();
$eventManager->subscribe($observer);
$eventManager->dispatch(['description' => 'Some event data']);

/*
Итератор. Указывает правила, по которым можно перебрать данные.
Для восстановления нужно ввести понятие текущего элемента, придумать логику как из текущего эелемента перейти к следующему, как проверить что мы дошли до конца массива, и как начать перебор сначала. Воспроизвести эту логику в методах из стандартного интерфейса Iterator
*/

class IteratorExample
{
	protected $data = [
		[1, 2, 3],
		[4, 5, 6]
	];
	
	//Будем проходить массив по рядкам. Для этого вводим понятия текущего рядка и колонки
	protected $rowIdx;
	protected $colIdx;

	public function rewind() {
		$this->rowIdx = 0;
		$this->colIdx = 0;
	}

	public function next() {
		// Перемещаем указатель вправо. Если справа элементов нет - перемещаем указатель вниз и сдвигаем влево в самое начало
		$this->colIdx++;
		if (!isset($this->data[$this->rowIdx][$this->colIdx])) {
			$this->rowIdx++;
			$this->colIdx = 0;
		}
	}

	public function current() {
		return $this->data[$this->rowIdx][$this->colIdx];
	}

	public function valid() {
		return isset($this->data[$this->rowIdx][$this->colIdx]);
	}

	public function key() {
		//Возвращает координаты в массиве через точку с запятой
		return $this->rowIdx . ';' . $this->colIdx;
	}
}

$myIterator = new IteratorExample();
$myIterator->rewind();
while($myIterator->valid()) {
	var_dump($myIterator->current());
	var_dump($myIterator->key());
	$myIterator->next();
}

/*
ActiveRecord Запись в базе данных, представленная в ПХП-объекте
Для восстановления:
- Создать класс, обеспечить ему доступ к базе (через PDO,например)
- Прописать у него логику хранения данных (через поля, или более абстрактный массив $_data)
- Прописать логику загрузки и сохранения данных в базе
*/

class ActiveRecord
{
	protected $pdo;
	
	public $id;
	public $name;
	public $author_id;

	public function __construct() {
		$dsn = 'mysql:host=localhost;dbname=models_php10';
		$login = 'root';
		$password = '';
		$this->pdo = new PDO($dsn, $login, $password);
	}
	public function query($sql, $params) {
		$statement = $this->pdo->prepare($sql);
		$statement->execute($params);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}

	public function load($id) {
		$sql = 'SELECT * FROM `books` WHERE id = ?';
		$result = $this->query($sql, [$id]);
		if (count($result)) {
			$record = $result[0];
			$this->id = $record['id'];
			$this->name = $record['name'];
			$this->author_id = $record['author_id'];
		}
	}

	public function save() {
		if ($this->id) {
			$sql = 'UPDATE `books` SET name = ?, author_id = ? WHERE id = ?';
			$this->query($sql, [$this->name, $this->author_id, $this->id]);
		} else {
			$sql = 'INSERT INTO `books` (name, author_id) VALUES (?, ?)';
			$this->query($sql, [$this->name, $this->author_id]);
		}
	}
}

$bookRecord = new ActiveRecord();
$bookRecord->load(5);
$bookRecord->name = '-new name-';
$bookRecord->save();

$newBookRecord = new ActiveRecord();
$newBookRecord->name = 'inserted book';
$newBookRecord->author_id = 45;
$newBookRecord->save();

/*
EAV. Шаблон, позволяющий хранить таблицы которые разростаются и в высоту, и в ширину.
Для восстановления выделить таблицу с Entity (рядки Products), таблицу с Attribute (колонки Products), и таблицу с Value (все остальные данные в Products, которые были не null). В Value будет записано для какого Entity и Attribute это значение.
*/
/*
Products
name | price | color | power
phone| 12    | null  | 18
book | 5     |white  | null

------

Entity
id | name
1  | phone
2  | book

Attribute
id | name
1  | color
2  | power
3  | price

Value
product_id | attribute_id | value
1          | 3            | 12
2          | 3            | 5
1          | 2            | 18
2          | 1            | white
*/

/*
Автозагрузчик. Инструмент, позволяющий ПХП самому искать классы и разрешает нам не записывать require-ы.
Для восстановления нужно прописать логику, по которой из названия класса можно получить путь к файлу, и зарегистрировать эту логику через spl_autoload_register
*/
/* вместо
require_once('classes/MyClass.php');
require_once('classes/AnotherClass.php');
*/

function autoload($className) {
	$path = 'classes/' . $className . '.php';
	if (is_file($path)) {
		require_once($path);
	}
}
spl_autoload_register('autoload');

$myClass = new MyClass();
$anotherClass = new AnotherClass();
var_dump($myClass, $anotherClass);
