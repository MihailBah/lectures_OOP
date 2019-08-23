<?php

Interface MyIterable
{
	public function rewind();
	public function hasNext();
	public function getNext();
}

class MyListNode 
{
	public $data;
	public $next;

	public function __toString() {
		return (string)$this->data;
	}
}

class MyList implements MyIterable
{
	protected $start;
	protected $currentNode;

	public function append($data) {
		if (!$this->start) {
			$this->start = new MyListNode();
			$this->start->data = $data;
			return;
		}
		$newNode = new MyListNode();
		$newNode->data = $data;
		$lastNode = $this->getLastNode();
		$lastNode->next = $newNode;
	}

	public function getLastNode() {
		$result = $this->start;
		while($result->next) {
			$result = $result->next;
		}
		return $result;
	}

	public function hasNext() {
		return !empty($this->currentNode);
	}

	public function getNext() {
		$result = $this->currentNode;
		$this->currentNode = $this->currentNode->next;
		return $result;
	}

	public function rewind() {
		$this->currentNode = $this->start;
	}
}


$myList = new MyList();

$myList->append(1);
$myList->append(2);
$myList->append(3);


class MyArray implements MyIterable
{
	protected $data = [1,2,3];
	protected $index;
	public function rewind() {
		$this->index = 0;
	}
	public function hasNext() {
		return (!empty($this->data[$this->index]));
	}
	public function getNext() {
		$result = $this->data[$this->index];
		$this->index++;
		return $result;
	}
}


$myArray = new MyArray();




function printMyList(MyIterable $myList) {
	$myList->rewind();
	while($myList->hasNext()) {
		$nextNode = $myList->getNext();
		echo $nextNode . '<br>';
	}
}

foreach ($myList as $item) {
	echo $item;
}


printMyList($myList);
printMyList($myArray);
