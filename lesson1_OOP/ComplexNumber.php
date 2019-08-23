<?php


$real = 4;

class Complex
{
	public $real;
	public $imaginary;
	private $innerIdx = 9;

	public function setIndex($newValue) {
		$this->innerIdx = $newValue;
	}
}

$num1 = 3;
$num2 = 5;

$result = $num1 + $num2;


$complex1 = new Complex();
$complex2 = new Complex();

$complex1->real = 3;
$complex1->imaginary = 6;

$complex2->real = 3;
$complex2->imaginary = 6;

$resultComplex = new Complex();
$resultComplex->real = $complex1->real + $complex2->real;
$resultComplex->imaginary = $complex1->imaginary + $complex2->imaginary;

// $resultComplex->innerIdx = $newValue;
var_dump($resultComplex->real);
var_dump($real);
