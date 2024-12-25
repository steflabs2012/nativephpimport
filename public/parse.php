<?php

require_once __DIR__ . '/../bootstrap.php';

$filePath = __DIR__ . '/parsedata/items.csv';

/** @var MainController $controller */

try {
    $controller->importFromCSV($filePath);
    echo "Импорт завершен!";
} catch (\Throwable $e) {
    echo $e->getMessage();
}


