<?php

require_once __DIR__ . '/app/Controllers/MainController.php';
require_once __DIR__ . '/app/Services/CSVImportService.php';
require_once __DIR__ . '/app/Models/Item.php';

use App\Controllers\MainController;

$config = require __DIR__ . '/config/db.php';
$dsn    = "mysql:host={$config['host']};dbname={$config['dbname']};charset=utf8";
$db     = new PDO($dsn, $config['user'], $config['password']);


$controller = new MainController($db);