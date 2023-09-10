<?php

require __DIR__ . '/vendor/autoload.php';

use thiagoalessio\TesseractOCR\TesseractOCR;

$data = [];

foreach (glob(__DIR__ . '/images/*') as $index => $file) {
    $data[$index]['file'] = $file;

    try {
        $data[$index]['text'] = (new TesseractOCR($file))->run();
    } catch (Exception $e) {
        $data[$index]['exception'] = $e->getMessage();
    }
}

$data = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
print_r($data . PHP_EOL);