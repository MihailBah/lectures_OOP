<?php

class Page
{
	public function render() {
		$result = $this->renderHeader();
		$result .= $this->renderContent();
		$result .= $this->renderFooter();
	}
	public function renderHeader() {
		return '';
	}
	public function renderContent() {
		return '';
	}
	public function renderFooter() {
		return '';
	}
}

class WebsitePage extends Page
{
	public function renderHeader() {
		$result = 'This is Header';
		$result .= '((Notification))';
		return $result;
	}
	public function renderFooter() {
		return 'This is Footer';
	}
}

class CategoryPage extends WebsitePage
{
	public function renderContent() {
		$result = $this->renderSidebar();
		$result .= $this->renderProducts();
	}
}

class ProductPage extends WebsitePage
{
	public function renderContent() {
		$result .= $this->renderProduct();
	}
}
