<?php

interface DbConnection
{
	public function connect($credentials);
	public function select($filters);
	//...
}

class MySqlConnection implements DbConnection
{
	public function connect($credentials) {
		//...
	}

	public function select($filter) {
		//...
	}
	//...
}

class PostgreSqlConnection implements DbConnection
{
	public function connect($credentials) {
		//...
	}

	public function select($filter) {
		//...
	}
	//...
}

function getBooksByAuthor(DbConnection $connection) {
	$connection->connect(['user', 'password']);
	$connection->select([
		'table' => 'books',
		'author' => 'Lev Tolstoy'
	]);
}

$postgreSqlConnection = new PostgreSqlConnection();
$books = getBooksByAuthor($postgreSqlConnection);
