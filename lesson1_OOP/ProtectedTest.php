<?php

class A
{
	protected $protectedValue;
	private $privateValue;
}

class B extends A
{
	public function getValue() {
		// Вернет ошибку
		// return $this->privateValue;
		return $this->protectedValue;
	}
}
