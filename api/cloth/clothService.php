<?php
require_once ('api/db.php');
class clothService
{
    protected $connection;
    function __construct($connection)
    {
        $this->connection = $connection;
    }
    // Получить все
    public function getAll()
    {
        $query = "
        SELECT * FROM `cloth`
        ";

        $res = mysqli_query($this->connection, $query);

        $cloth = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($cloth, $row);
                // print_r($row);
                // echo "<br>";
            }
        }

        return $cloth;
    }
    // Получить один
    public function getOne($clothId)
    {
        $query = "
        SELECT * FROM `cloth` WHERE id=$clothId;
        ";

        $res = mysqli_query($this->connection, $query);

        $cloth = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($cloth, $row);
                // print_r($row);
                // echo "<br>";
            }
        }
        return $cloth;
    }
    // Добавить один
    public function addOne($type, $size, $color, $brand, $header, $description, $cost, $imgSrc)
    {
        // Проверяем, есть ли уже такая запись
        $query = "
            SELECT * 
            FROM `cloth`
            WHERE 
            `type` = $type AND
            `size` = $size AND
            `color` = $color AND
            `brand` = $brand AND
            `header` = $header AND
            `description` = $description AND
            `cost` = $cost AND
            `imgSrc` = $imgSrc
            ";

        $res = mysqli_query($this->connection, $query);

        if ($res->num_rows > 0) {
            return ['error' => "Ошибка! Такая вещь уже есть в магазине!"];
        }


        // Добавляем пользователя
        echo "$type, $size, $color, $brand, $header, $description, $cost, $imgSrc";
        $query = "
        INSERT INTO `cloth`(`type`, `size`, `color`, `brand`, `header`, `description`, `cost`, `imgSrc`) 
        VALUES ('$type', '$size', '$color', '$brand', '$header', '$description', '$cost', '$imgSrc');
        ";

        $res = mysqli_query($this->connection, $query);
        print_r($res);

        // делаем запрос на получение той строки, которую мы ТОЛЬКО ЧТО добавили
        if ($res == 1) {
            $query = "
            SELECT * 
            FROM `cloth`
            WHERE 
            `type` = $type AND
            `size` = $size AND
            `color` = $color AND
            `brand` = $brand AND
            `header` = $header AND
            `description` = $description AND
            `cost` = $cost AND
            `imgSrc` = $imgSrc";

            $res = mysqli_query($this->connection, $query);

            $row = [];
            if ($res->num_rows > 0) {
                $row = mysqli_fetch_assoc($res);
            }
            echo "321";
            return $row;
        }
    }
    // Обновить один
    public function updateOne($clothId, $type, $size, $color, $brand, $header, $description, $cost)
    {
        $query = "
        UPDATE `cloth` 
        SET 
        `type`= $type, 
        `size`= $size, 
        `color`= $color, 
        `brand`= $brand, 
        `header`= $header, 
        `description`= $description,
        `cost`= $cost,
        WHERE id= $clothId;
        ";

        $res = mysqli_query($this->connection, $query);
        // print_r($res);

        // Проверка, что запрос выполнился, и строка с новыми параметрами существует
        $query = "
        SELECT *
        FROM `cloth`
        WHERE 
        `id` = `$clothId` AND 
        `type`= $type AND
        `size`= $size AND 
        `color`= $color AND
        `brand`= $brand AND
        `header`= $header AND
        `description`= $description AND
        `cost`= $cost
        ";
        $res = mysqli_query($this->connection, $query);

        if ($res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);
            return $row;
        } else {
            return [
                'error' => "Ошибка при обновлении данных!"
            ];
        }
    }
    // Удалить один
    public function deleteOne($clothId)
    {
        // Получаем строку для возврата
        $query = "
        SELECT * 
        FROM `cloth` 
        WHERE id= $clothId;
        ";

        $res = mysqli_query($this->connection, $query);

        $row = [];
        if ($res->num_rows > 0) {
            $row = mysqli_fetch_assoc($res);
        } else {
            return [
                'error' => "Ошибка! Запись не найдена"
            ];
        }
        // Удаляем строку
        $query = "
        DELETE FROM `cloth` 
        WHERE id= $clothId;
        ";

        $res = mysqli_query($this->connection, $query);

        // Удаляем из корзины
        $query = "
        DELETE FROM `busketToCloth` 
        WHERE clothId= $clothId;
        ";

        $res = mysqli_query($this->connection, $query);
        // Удаляем из избранного
        $query = "
        DELETE FROM `favoriteToCloth` 
        WHERE clothId= $clothId;
        ";

        $res = mysqli_query($this->connection, $query);

        // Удаляем из заказов
        $query = "
        DELETE FROM `ordersToCloth` 
        WHERE clothId= $clothId;
        ";

        $res = mysqli_query($this->connection, $query);

        return $row;
    }
}

$clothService = new clothService($connection);