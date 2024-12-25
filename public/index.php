<?php

require_once __DIR__ . '/../bootstrap.php';

/** @var MainController $controller */
$items = $controller->getItems();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Список товаров</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="p-3">
<h1>Список товаров</h1>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>Код</th>
        <th>Наименование</th>
        <th>Уровень 1</th>
        <th>Уровень 2</th>
        <th>Уровень 3</th>
        <th>Цена</th>
        <th>Цена СП</th>
        <th>Количество</th>
        <th>Поля свойств</th>
        <th>Совместные покупки</th>
        <th>Единица измерения</th>
        <th>Картинка</th>
        <th>Выводить на главной</th>
        <th>Описание</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?php echo  htmlspecialchars($item['code']) ?></td>
            <td><?php echo  htmlspecialchars($item['name']) ?></td>
            <td><?php echo  htmlspecialchars($item['level1']) ?></td>
            <td><?php echo  htmlspecialchars($item['level2']) ?></td>
            <td><?php echo  htmlspecialchars($item['level3']) ?></td>
            <td><?php echo  htmlspecialchars($item['price']) ?></td>
            <td><?php echo  htmlspecialchars($item['price_sp']) ?></td>
            <td><?php echo  htmlspecialchars($item['quantity']) ?></td>
            <td><?php echo  htmlspecialchars($item['property_fields']) ?></td>
            <td><?php echo  htmlspecialchars($item['joint_purchases']) ?></td>
            <td><?php echo  htmlspecialchars($item['unit']) ?></td>
            <td><?php echo  htmlspecialchars($item['image_path']) ?></td>
            <td><?php echo  htmlspecialchars($item['show_on_main']) ?></td>
            <td><?php echo  htmlspecialchars($item['description']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>