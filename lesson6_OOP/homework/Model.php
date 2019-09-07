<?php
/*
Модель. Класс, объект которого представляет запись в БД.
Модель хранит в своих полях информацию из колонок таблицы, имеет методы  load($id) и save(). Для работы модели нужен класс, который умеет общаться с базой, в нашем случае это Connection из DbConnection.php
Здесь модель разделена на абстрактную и конкретную. Абстрактная хранит общую логику загрузки/сохраниения данных, конкретная - название таблицы и другую специфическую информацию (если есть)
*/
require_once('DbConnection.php');

abstract class AbstractModel
{
	protected $id;
	protected $connection;

	protected $_data;

	public function __construct(Connection $connection) {
		$this->connection = $connection;
	}


	public function load($id) {
		$sql = 'SELECT * FROM `' . $this->tableName . '` WHERE id = ?';
		$result = $this->connection->query($sql, [$id]);

		if (count($result)) {
			$this->id = $result[0]['id'];
			$this->_data = $result[0];
			// $this->fillData($result);
		}
	}

	/*
	Две функции ниже - заготовка для ДЗ. Внутри __call будет код из ДЗ25, который заполнит массив $this->_data. В save() этот массив будет использоваться для построения запросов.

	public function __call($method, $args) {
		//Из MagicArray
	}
	*/
	public function save() {

		$this->_data = [
			'name' => $this->name
		];

		if ($this->id) {
			$keys = array_keys($this->_data);
			foreach ($keys as &$key) {
				$key .= ' = ?';
			}
			// var_dump($keys);
			$sql = 'UPDATE `' . $this->tableName . '` SET ' . implode(',', $keys) . ' WHERE id = ?';
			$params = array_values($this->_data);
			$params[] = $this->id;

			// var_dump($sql, $params);die;

			$this->connection->query($sql, $params);
		} else {
			$questionMarks = [];
			foreach ($this->_data as $item) {
				$questionMarks[] = '?';
			}

			$keys = implode(',', array_keys($this->_data));
			$sql = 'INSERT INTO ' . $this->tableName 
			. ' (' . $keys . ') VALUES (' . implode(',', $questionMarks) . ')';


			$this->connection->query($sql, array_values($this->_data));
		}
	}
}

class AuthorModel extends AbstractModel
{
	protected $tableName = 'authors';

	public $name;

	/*
	fillData в этом классе вызывается методом load() из класса-родителя
	*/
	protected function fillData($record) {
		$this->id = $record[0]['id'];
		$this->name = $record[0]['name'];
	}

	public function save() {
		if ($this->id) {
			$sql = 'UPDATE `authors` SET name = ? WHERE id = ?';
			$result = $this->connection->query($sql, [$this->name, $this->id]);
		} else {
			$sql = 'INSERT INTO `authors` (name) VALUES (?)';
			$result = $this->connection->query($sql, [$this->name]);
		}
	}
}

$model = new AuthorModel(Connection::getInstance());
$model->load(1);
$model->name .= '(edit)';
$model->save();
var_dump($model);

$model2 = new AuthorModel(Connection::getInstance());
$model2->name = 'Viktor Ivanov';
$model2->save();





$bookModel = new BookModel();
$bookModel->load(3);
var_dump($bookModel->_data);
$bookModel->_data['author_id'] = 33;
$bookModel->save();

$_data = [
	'author_id' = 33,
	'name' = 'SomeName'
];
$params = array_values($_data);
$params = [
	33,
	'SomeName'
];



$_data = array_keys($_data);
$_data = [
	'author_id',
	'name'
];
foreach ($_data as &$item) {
	$item .= ' = ?';
}
$_data = [
	'author_id = ?',
	'name = ?'
];

$result = $_data[0] . ','.$_data[1];
$result = implode(',', $_data);

author_id = ?, name = ?



update books set name = ? author_id = ?, id = ? where id = ?




