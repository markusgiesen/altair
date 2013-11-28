<?php

function widont($text) {
	$widont = new widont($text);
	return $widont->replace();
}

class widont {

	// idea: built in check if text is passed
	// var $text = null;

	function __construct($text) {

		// create widont class with variables
		$this->create($text);

	}

	function create($text) {
		// set passed text as class variable
		$this->text = $text;
	}

	function replace() {

		$html = $this->text;

		// if the text contains more that 3 spaces
		if(substr_count($this->text, ' ') > 2){
			// remove last space by &nbsp; character
			$widont_text = preg_replace('/\s+(\S+)$/', '&#160;$1', rtrim($this->text));
			// set this as the return value
			$html = $widont_text;
		}

		return $html;

	}

}