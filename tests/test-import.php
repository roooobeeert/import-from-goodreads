<?php

require __DIR__ . '/../vendor/autoload.php';

use Rober\ImportFromGoodreads\Service\GoodReadsImporter;


$importer = new GoodReadsImporter();


$csvFile = __DIR__ . '/goodreads_library_export.csv';

try {
    $books = $importer->import_goodreads($csvFile);
    print_r($books);
} catch (Exception $e){
    echo 'Fehler: '. $e->getMessage();
}