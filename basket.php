<?php session_start();
include ('./api/basket/basketController.php');
include ('./api/orders/ordersController.php');
?>
<?php
if (isset($_GET['delFromBasket'])) {

  $res = $basketController->deleteOne($_SESSION['userId'], $_GET['delFromBasket']);
  echo "<script> alert('Товар удалён из корзины') </script>";
}
if (isset($_GET['order'])) {
  $basket = $basketController->getOne($_SESSION['basketId']);
  
  foreach ($basket as $key => $value) {
    $articul = $value['articul'];
    $getKey = "count$articul";
    $count = $_GET[$getKey];

    //  $basket[$key] === $value
    $basket[$key]['count'] = $count;
  }


  $res = $ordersController->addOne($_SESSION['userId'], $basket, $_GET['adress'], $_GET['payOffline']);
  echo "<script> alert('Заказ оформлен') </script>";
}
?>
<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles/index.css">
  <title>Корзина</title>
</head>

<body>
  <form action="" method="GET">

    <?php
    require_once ('./components/navbar.php');
    ?>
    <?php
    $basket = $basketController->getOne($_SESSION['basketId']);
    print_r($basket);

    foreach ($basket as $index => $cloth) {
      $imgSrc = $cloth['imgSrc'];
      $articul = $cloth['articul'];
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
                <div class='count'>
                  <input id='count$articul' type='text' name='count$articul' value='1' />
                </div>
                <button name='delFromBasket' value='$articul'> Удалить </button>
        </div>
            ";
    }
    ?>

    <br><br><br>
    <div class="buy">
      <input type="text" name="adress" placeholder="Адрес"> <br>

      <select name="payOffline">
        <option value="1">Оплата оффлайн</option>
        <option value="0">Оплата онлайн</option>
      </select> <br>

      <button name="order" value="order">Оформить заказ</button>
    </div>
  </form>
</body>

</html>