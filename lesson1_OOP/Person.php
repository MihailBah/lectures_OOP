<?php

class Person
{
	public $name;
	public $surname;

	public function __construct($name, $surname) {
		$this->name = $name;
		$this->surname = $surname;
	}

	public function getName() {
		return $this->name . ' ' . $this->surname;
	}
}

class Student extends Person
{
	public $university;

	public function __construct($name, $surname, $university) {
		parent::__construct($name, $surname);
		$this->university = $university;
	}

	public function getName() {
		return parent::getName() . ' studying in ' . $this->university;
	}
}



$student = new Student('Vasily', 'Petrov', 'Karazina University');
var_dump($student);

echo $student->getName();


// $person = new Person('Vasily', 'Petrov');

// var_dump($person);
// $person->age = 25;

// var_dump($person);
