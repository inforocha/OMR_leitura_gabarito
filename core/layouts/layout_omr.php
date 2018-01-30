<?php
	interface LayoutOMR {
		public function createFieldCode(PaperSheet $paper);
		public function createFieldAnswers(PaperSheet $paper);
		public function getPaperWidth();
		public function getPaperHeight();
	}