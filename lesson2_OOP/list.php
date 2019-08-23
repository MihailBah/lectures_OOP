<?php

class MyListNode 
{
	public $data;
	public $next;
}

class MyList
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



// class MyArray
// {
// 	protected $data = [1,2,3]
// }




function printMyList($myList) {
	// $myList->rewind();
	while($myList->hasNext()) {
		$nextNode = $myList->getNext();
		echo $nextNode->data . '<br>';
	}
}
printMyList($myList);
$myList->revert();
printMyList($myList);



// echo '<pre>';
// print_r($myList);
die;
