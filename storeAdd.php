<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить товар</title>
    <link rel="stylesheet" href="./styles/index.css">
</head>

<body>
    <?php
    require_once ('./components/navbar.php');
    ?>
    <form enctype="multipart/form-data" action="" method="POST">
        <input type="text" placeholder="Тип (футболка, штаны)" name="type" required><br>
        <input type="text" placeholder="Размер (s, l)" name="size" required><br>
        <input type="text" placeholder="Цвет" name="color" required><br>
        <input type="text" placeholder="Брэнд" name="brand" required><br>
        <input type="text" placeholder="Название товара" name="header" required><br>
        <input type="text" placeholder="Описание товара" name="description" required><br>
        <input type="text" placeholder="Цена" name="cost" required><br>
        <input type="file" name="img" required><br>
        <button>Добавить</button>
    </form>
</body>

</html>

<?php
include_once ('./api/cloth/clothController.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $uploaddir = 'static/';
    $uploadfile = $uploaddir . basename($_FILES['img']['name']);
    move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile);
    print_r($_POST);
    $res = $clothController->addOne(
        $_POST['type'],
        $_POST['size'],
        $_POST['color'],
        $_POST['brand'],
        $_POST['header'],
        $_POST['description'],
        +$_POST['cost'],
        $uploadfile
    );
    print_r($res);
    echo "Товар добавлен";
}
?>