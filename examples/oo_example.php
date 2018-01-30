<?php
require_once '../constants.php';
require_once DOMAIN_PATH_OMR.'file_reader_omr.php';
require_once DOMAIN_PATH_OMR.'core/layouts/layout_modelo1.php';


$layout = new LayoutModelo1();
$fileReader = new FileReaderOMR($layout);
$fileReader->processReadings();
$pathFileName = $fileReader->processTxt();

header('Content-type: text/plain');
header("Content-Disposition: attachment; filename=\"" . $pathFileName . "\"");
ob_clean();