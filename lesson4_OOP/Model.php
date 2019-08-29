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
			$this->fillData($result);
		}
	}

	/*
	Две функции ниже - заготовка для ДЗ. Внутри __call будет код из ДЗ25, который заполнит массив $this->_data. В save() этот массив будет использоваться для построения запросов.

	public function __call($method, $args) {
		//Из MagicArray
	}
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
		}
	}
	*/
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
$model->load(3);
$model->name .= '(edit)';
$model->save();
var_dump($model);

// $model2 = new AuthorModel(Connection::getInstance());
// $model2->name = 'Viktor Ivanov';
// $model2->save();




