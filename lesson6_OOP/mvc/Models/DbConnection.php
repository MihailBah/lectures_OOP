<?php
/*
Пример синглтона. Класс хранит информацию о том, как подключаться к базе данных и как делать запросы.
*/
class Connection
{
	protected static $instance;

	protected $pdo;

	protected function __construct() {
		$dsn = 'mysql:host=localhost;dbname=models_php10';
		$login = 'root';
		$password = '';
		$this->pdo = new PDO($dsn, $login, $password);
	}

	public static function getInstance() {
		if (!self::$instance) {
			self::$instance = new Connection();
		}
		return self::$instance;
	}

	public function query($sql, $params) {
		$statement = $this->pdo->prepare($sql);
		$statement->execute($params);
		return $statement->fetchAll(PDO::FETCH_ASSOC);
	}
}
