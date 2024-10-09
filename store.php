<?php
session_start();
// Костыль, как будто мы уже зарегистрировались и знаем всё о пользователе
// $_SESSION['isAuth'] = true;
// $_SESSION['basketId'] = 1;
// $_SESSION['userId'] = 1;
// $_SESSION['userRole'] = "admin";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/index.css">
    <title>Каталог</title>
</head>

<body>
    <?php
    require_once ('./components/navbar.php');
    ?>
    <?php
    if ($_SESSION['role'] == 'admin') {
        echo "<a href='storeAdd.php'> Добавить товар </a>";
        echo "<a href='storeDelete.php'> Удалить товар </a>";
    }
    ?>
    <div class="cards">
        <?php
        include_once ('./api/cloth/clothController.php');
        $clothArray = $clothController->getAll();

        // print_r($clothArray);
        foreach ($clothArray as $index => $cloth) {
            $imgSrc = $cloth['imgSrc'];
            $articul = $cloth['id'];
            $type = $cloth['type'];
            $size = $cloth['size'];
            $color = $cloth['color'];
            $brand = $cloth['brand'];
            $header = $cloth['header'];
            $description = $cloth['description'];
            $cost = $cloth['cost'];
            echo "
                <div class='card'>
                    <img src='$imgSrc' alt=''> <br>
                    <h4> Артикул: $articul </h4>
                    <h4> Тип: $type </h4>
                    <h4> Размер: $size </h4>
                    <h4> Цвет: $color </h4>
                    <h4> Бренд: $brand </h4>
                    <h4> Название: $header </h4>
                    <h4> Описание: $description </h4>
                    <h4> Цена: $cost </h4>
                    <form action='' method='GET'>
                        <button name='addToBasket' value='$articul'> В корзину </button>
                    </form>
                </div>
            ";
        }
        ?>
    </div>
</body>

</html>

<?php
if (isset($_GET['addToBasket'])) {
    include_once ('./api/basket/basketController.php');
    $userBasket = $basketController->getOne($_SESSION['userId']);
    $inBasket = false;
    foreach ($userBasket as $index => $clothInBasket) {
        if ($_GET['addToBasket'] == $clothInBasket['articul']) {
            $inBasket = true;
        }
    }
    if ($inBasket) {
        echo "<script> alert('Такой товар уже есть') </script>";
    } else {
        $basketId =  $_SESSION['basketId'];
        $res = $basketController->addOne($_SESSION['basketId'], $_GET['addToBasket'], 1);
        echo "<script> alert('Товар добавлен в корзину $basketId') </script>";
    }
}
?>