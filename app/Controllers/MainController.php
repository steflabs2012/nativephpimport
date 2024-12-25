<?php

namespace App\Controllers;

use App\Models\Item;
use App\Services\CSVImportService;
use PDO;

class MainController
{
    protected PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function importFromCSV(string $filePath)
    {
        CSVImportService::import($filePath, $this->db);
    }

    public function getItems()
    {
        $item = new Item($this->db);
        return $item->getItems();
    }

//    public function processLoading()
//    {
//        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) {
//            $uploadDir = __DIR__ . '/../../public/parsedata/';
//            $uploadFile = $uploadDir . 'items.csv';
//
//            if (!is_dir($uploadDir)) {
//                mkdir($uploadDir, 0755, true);
//            }
//
//            if (move_uploaded_file($_FILES['csv_file']['tmp_name'], $uploadFile)) {
//                echo '<div class="alert alert-success">Файл успешно загружен!</div>';
//            } else {
//                echo '<div class="alert alert-danger">Ошибка загрузки файла!</div>';
//            }
//        }
//    }
    public function processLoading()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['csv_file'])) {
            $uploadDir = __DIR__ . '/../../public/parsedata/';
            $uploadFile = $uploadDir . 'items.csv';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            if (move_uploaded_file($_FILES['csv_file']['tmp_name'], $uploadFile)) {
                echo '<div class="alert alert-success">Файл успешно загружен!</div>';
            } else {
                echo '<div class="alert alert-danger">Ошибка загрузки файла!</div>';
            }
        }
    }

    public function handleActions()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
            switch ($_POST['action']) {
                case 'parse_csv':
                    $this->parseCSV();
                    break;
                case 'clear_items':
                    $item = new Item($this->db);
                    $item->clearTable();
                    break;
            }
        }
    }

    private function parseCSV()
    {
        $filePath = __DIR__ . '/../../public/parsedata/items.csv';

        if (!file_exists($filePath)) {
            echo '<div class="alert alert-danger">CSV файл не найден!</div>';
            return;
        }

        try {
            $this->importFromCSV($filePath);
            echo '<div class="alert alert-success">Импорт завершен!</div>';
        } catch (\Throwable $e) {
            echo '<div class="alert alert-danger">Ошибка импорта: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    }

    private function clearItems()
    {
        try {
            // Очистка таблицы items (пример на PDO):
            $pdo = new PDO('mysql:host=localhost;dbname=your_database', 'username', 'password');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->exec('TRUNCATE TABLE items');

            echo '<div class="alert alert-success">Таблица items успешно очищена!</div>';
        } catch (\Throwable $e) {
            echo '<div class="alert alert-danger">Ошибка очистки таблицы: ' . htmlspecialchars($e->getMessage()) . '</div>';
        }
    }
}
