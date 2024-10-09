<?php
session_start();
include('./api/orders/ordersController.php');

if (isset($_GET['complete'])) {
    $orderId = $_GET['complete'];
    $ordersController->updateOne($orderId);
}

$orders = $ordersController->getAll();
print_r($orders);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        table {
            border-collapse: collapse;
        }

        td {
            border: 1px solid black;
        }
    </style>

    <?php
    require_once('./components/navbar.php');
    ?>
    <table>
        <thead>
            <tr>
                <td>Статус</td>
                <td>ID</td>
                <td>Адресс</td>
                <td>Тип оплаты</td>
                <td>ФИО</td>

                <td>Артикул</td>
                <td>Размер</td>
                <td>Название</td>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($orders as $order) {
                $rowspan = count($order->products);

                echo "<tr>";
                $completed = $order->completed;

                if ($completed == 1) {
                    echo "<td rowspan='$rowspan'> $completed </td>";
                } else {
                    ?>
                    <td rowspan='<?php echo "$rowspan" ?>'>
                        <form action="" method="GET">
                            <button name="complete" value="<?php
                        $orderId = $order->id;
                        echo "$orderId";
                        ?>"> Выполнить </button>
                        </form>
                    </td>
                    <?php
                }

                $id = $order->id;
                echo "<td rowspan='$rowspan'> $id </td>";

                $adress = $order->adress;
                echo "<td rowspan='$rowspan'> $adress </td>";

                $payOffline = $order->payOffline;
                echo "<td rowspan='$rowspan'> $payOffline </td>";

                $username = $order->username;
                echo "<td rowspan='$rowspan'> $username </td>";

                foreach ($order->products as $key => $product) {

                    if ($key !== 0) {
                        echo "<tr>";
                    }

                    $articul = $product->articul;
                    echo "<td> $articul </td>";

                    $size = $product->size;
                    echo "<td> $size </td>";

                    $header = $product->header;
                    echo "<td> $header </td>";

                    echo "</tr>";
                }




                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>