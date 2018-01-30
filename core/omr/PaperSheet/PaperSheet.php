<?php

class PaperSheet implements IteratorAggregate {
	private $matrixLength = array();
	private $fields = array();

	public function __construct($x, $y) {
		$this->matrixLength = array((int) $x, (int) $y);
	}

	public function addField(Field $field) {
		$this->fields[] = $field;
	}

	public function getMatrixLength() {
		return $this->matrixLength;
	}

	public function getFields() {
		return $this->fields;
	}

	public function getIterator() {
		return new ArrayIterator($this->fields);
	}
}