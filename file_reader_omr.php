<?php

	require_once 'constants.php';
	require_once DOMAIN_PATH_OMR.'core/helpers/file_helper.php';
	require_once DOMAIN_PATH_OMR.'core/omr/PaperSheet/PaperSheet.php';
	require_once DOMAIN_PATH_OMR.'core/omr/PaperSheet/Field.php';
	require_once DOMAIN_PATH_OMR.'core/omr/PaperSheet/Mark.php';
	require_once DOMAIN_PATH_OMR.'core/omr/Reader/Reader.php';
	/**
	* Responsavel por verificar os gabaristos que estao na pasta
	* e criar um arquivo texto baseado em um objeto de Layout
	* informado como parametro.
	*/
	class FileReaderOMR {

		private $readings = array();
		
		function __construct(LayoutOMR $layout) {
			$this->init($layout);
		}

		public function debug($imagePath) {
			echo '<pre>';
			$reader = $this->instanceReader($imagePath);
			var_dump($reader->getResults());
			die;
		}

		public function getReadings() {
			return $this->readings;
		}

		// somente caso necessite de um arquivo texto.
		public function processTxt() {
			$id = date("d-m-Y_H-i-s");
			$path = DOMAIN_PATH_OMR."readings/".$id.".txt";

			$file = fopen($path, 'a');
			foreach ($this->readings as $reading) {
				$data = '';
				foreach ($reading as $key => $mark) {
					$data .= $mark['value'];
				}

				if (!empty($data)) {
					$data .= "\n";
					fwrite($file, $data);
				}
			}
			fclose($file);
			return $path;
		}

		public function processReadings($delete = true) {
			$directoryFiles = DOMAIN_PATH_OMR.'images/';
			$files = get_filenames($directoryFiles);

			foreach ($files as $file) {
				$imagePath = $directoryFiles.DIRECTORY_SEPARATOR.$file;
				$reader = $this->instanceReader($imagePath);
				$this->readings[] = $reader->getResults();
				unset($reader);
			}

			if ($delete) {
				delete_files($directoryFiles);
			}
		}

		private function init($layout) {
			$paper = new PaperSheet($layout->getPaperWidth(), $layout->getPaperHeight());
			$paper = $layout->createFieldCode($paper);
			$paper = $layout->createFieldAnswers($paper);

			$this->paper = $paper;
		}

		private function instanceReader($imagePath) {
			$reader = new Reader($imagePath, $this->paper, 4);
			return $reader;
		}
	}