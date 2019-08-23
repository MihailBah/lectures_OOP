<?php

class Person
{
	public $name;
	public $surname;
	private $mother;
	private $father;
	public $children;

	public function __construct($name, $surname) {
		$this->name = $name;
		$this->surname = $surname;
	}

	public function setFather($newFather) {
		$this->father = $newFather;
		$newFather->children[] = $this;
	}

	public function setMother($newMother) {
		$this->mother = $newMother;
		$newMother->children[] = $this;
	}
}

$person1 = new Person('Vasily', 'Ivanov');
$person2 = new Person('Viktor', 'Ivanov');
$person3 = new Person('Stepan', 'Ivanov');
$person4 = new Person('Anna', 'Petrova');
$person5 = new Person('Svetlana', 'Sidorova');

// $person1->father = $person2;
// $person2->children[] = $person1;
$person1->setFather($person2);


$person1->setMother($person4);
$person2->setFather($person3);
$person2->setMother($person5);

var_dump($person2->children[0]);
