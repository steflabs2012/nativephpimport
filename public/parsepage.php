<?php
require_once __DIR__ . '/../bootstrap.php';

/** @var MainController $controller */
$controller->processLoading();
$controller->handleActions();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Загрузка CSV файла</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-3">
<h1>Загрузка CSV файла</h1>

<div class="row">
    <div class="mb-4 w-25">
        <form action="" method="POST" enctype="multipart/form-data" class="d-flex align-items-center gap-2">
            <input type="file" name="csv_file" class="form-control" accept=".csv" required>
            <button type="submit" class="btn btn-primary">Загрузить CSV</button>
        </form>
    </div>
</div>

<div class="row">
    <div class="mb-4 w-25">
        <form action="" method="POST" class="d-flex align-items-center gap-2">
            <button type="submit" name="action" value="parse_csv" class="btn btn-success">Спарсить CSV</button>
            <button type="submit" name="action" value="clear_items" class="btn btn-danger">Очистить таблицу</button>
        </form>
    </div>
</div>

</body>
</html>