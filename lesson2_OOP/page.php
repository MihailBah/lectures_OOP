<?php

abstract class Page
{
	protected $text;

	public function setText($text) {
		$this->text = $text;
	}

	abstract public function print();
}

class DocumentPage extends Page
{
	protected $header = 'name of company';
	protected $footer = 'Date, Signature';

	public function print() {
		echo $this->header . '<br>';
		echo $this->text . '<br>';
		echo $this->footer . '<br>';
	}
}

class JournalPage extends Page
{
	public function print() {
		echo $this->text . '<br>';
	}
}

class Printer
{
	public static function print(Page $page) {
		// $logger->logMessage('printing..');
		$page->print();
	}
}



$docPage = new DocumentPage();
$docPage->setText('this is document page');
Printer::print($docPage);
// $docPage->print();

$journalPage = new JournalPage();
$journalPage->setText('this is jounal page');
Printer::print($journalPage);
// $journalPage->print();

