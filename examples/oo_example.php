<?php
require_once '../constants.php';
require_once DOMAIN_PATH_OMR.'core/helpers/file_helper.php';
require_once DOMAIN_PATH_OMR.'file_reader_omr.php';
require_once DOMAIN_PATH_OMR.'core/layouts/layout_modelo1.php';


$layout = new LayoutModelo1();
$fileReader = new FileReaderOMR($layout);
$fileReader->processReadings(false);
//echo '<pre>';print_r($fileReader->getReadings());echo '</pre>';
$pathFileName = $fileReader->processTxt();

forceDownloadFile($pathFileName);