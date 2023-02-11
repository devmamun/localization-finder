<?php

include './Finder.php';

use Devmamun\LocalizationFinder\Finder;

if ($_REQUEST['query'] == 'execute') {
    $path =       $_POST['import_path'];
    $identifier = $_POST['identifier'];
    $exportPath = $_POST['export_path'];
    $exportFile = $_POST['export_file_name'] . '.' . $_POST['export_file_extension'];
    $export = $exportPath . '/' . $exportFile;

    $finder = new Finder;
    $finder->setIdentifier($identifier)
        ->setImportLocation($path)
        ->setExportLocation($export)
        ->execute();
}