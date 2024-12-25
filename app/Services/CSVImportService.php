<?php

namespace App\Services;

use App\Models\Item;
use Exception;

class CSVImportService
{
    public static function import(string $filePath, \PDO $db)
    {
        if (!file_exists($filePath)) {
            throw new Exception("Файл не найден: $filePath");
        }

        $content = file_get_contents($filePath);

        $content = preg_replace('/^Код;Наименование;[^\n]*\n/u', '', $content);

        $parts = preg_split('/^("?Б\d+;)/m', $content, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);

        for ($i = 0; $i < count($parts); $i += 2) {

            $block = $parts[$i] . $parts[$i + 1];

            $block = trim($block);

            $columns = explode(';', $block);

            $item = new Item($db);

            $item->fillFromColumns($columns);

            $item->save();
        }
    }
}