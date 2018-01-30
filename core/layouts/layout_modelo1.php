<?php

	require_once 'layout_omr.php';

	class LayoutModelo1 implements LayoutOMR {

		public function getPaperWidth() {
			return 38;
		}

		public function getPaperHeight() {
			return 54;
		}

		public function createFieldCode(PaperSheet $paper) {
			$dotsLines = array(1 => 19,20,21,22,23,24,25,26,27,28);

			for ($i = 29; $i <= 35; $i++) {
				$field = new Field('id');
				foreach ($dotsLines as $dot => $line) {
					$field->addMark(new Mark($line, $i, $dot));
				}
				$paper->addField($field);
			}

			return $paper;
		}

		public function createFieldAnswers(PaperSheet $paper) {
			$numberQuestion = 1;
			$columnPoints = array(
				array(3,4,5,6,7),
				array(10,11,12,13,14),
				array(17,18,19,20,21),
				array(24,25,26,27,28),
				array(31,32,33,34,35)
			);
			$answers = array('A','B','C','D','E');

			foreach ($columnPoints as $points) {
				for ($i = 31; $i <= 50; $i++) {
					$field = new Field(str_pad($numberQuestion, 2, '0', STR_PAD_LEFT));
					foreach ($answers as $key => $answer) {
						$field->addMark(new Mark($i, $points[$key], $answer));
					}

					$paper->addField($field);
					$numberQuestion++;
				}
			}

			return $paper;
		}
	}