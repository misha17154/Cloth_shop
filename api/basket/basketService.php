<?php
require_once ('./api/db.php');
class basketService
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
        SELECT C.id AS articul, BTC.busketId AS busketId, C.type, C.size, C.color, C.brand, C.header, C.description, C.cost, BTC.count
        FROM `cloth` AS C, `busketToCloth` AS BTC
        WHERE BTC.clothId = C.id;
        ";

        $res = mysqli_query($this->connection, $query);

        $baskets = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($baskets, $row);
                // print_r($row);
                // echo "<br>";
            }
        }

        return $baskets;
    }
    // Получить один
    public function getOne($basketId)
    {
        $query = "
        SELECT C.id AS articul, BTC.busketId AS busketId, C.type, C.size, C.color, C.brand, C.header, C.description, C.cost, C.imgSrc, BTC.count
        FROM `cloth` AS C, `busketToCloth` AS BTC
        WHERE BTC.clothId = C.id AND BTC.busketId = $basketId;
        ";

        $res = mysqli_query($this->connection, $query);

        $userBasket = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($userBasket, $row);
                // print_r($row);
                // echo "<br>";
            }
        }
        return $userBasket;
    }
    // Добавить один
    public function addOne($basketId, $clothId, $count)
    {
        // Проверяем, есть ли уже такая запись
        $query = "
            SELECT * 
            FROM `busketToCloth`
            WHERE 
            `busketId` = $basketId AND
            `clothId` = $clothId";

        $res = mysqli_query($this->connection, $query);

        if ($res->num_rows > 0) {
            return ['error' => "Ошибка! Товар уже был добавлен в корзину!"];
        }

        // Добавляем продукт в корзину
        $query = "
        INSERT INTO `busketToCloth`(`busketId`, `clothId`, `count`) 
        VALUES ($basketId, $clothId, $count)
        ";

        $res = mysqli_query($this->connection, $query);

        // делаем запрос на получение той строки, которую мы ТОЛЬКО ЧТО добавили
        if ($res == 1) {
            $query = "
            SELECT * 
            FROM `busketToCloth`
            WHERE 
            `busketId` = $basketId AND
            `clothId` = $clothId AND
            `count` = $count";

            $res = mysqli_query($this->connection, $query);

            $row = [];
            if ($res->num_rows > 0) {
                $row = mysqli_fetch_assoc($res);
            }
            return $row;
        }
    }
    // Обновить один
    public function updateOne($busketToClothId, $newCount)
    {
        $query = "
        UPDATE `busketToCloth` 
        SET `count`= $newCount
        WHERE id= $busketToClothId;
        ";

        $res = mysqli_query($this->connection, $query);
        // print_r($res);

        // Проверка, что запрос выполнился, и строка с новыми параметрами существует
        $query = "
        SELECT *
        FROM `busketToCloth`
        WHERE id = $busketToClothId AND `count`= $newCount
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
    public function deleteOne($userId, $clothId)
    {
        // Получаем одежду которую удаляем и id записи в busketToCloth (BTCid)
        $query = "
        SELECT busketToCloth.id as BTCid, cloth.id, cloth.type, cloth.size, cloth.brand, cloth.color, cloth.header, cloth.description, cloth.cost 
        FROM `busketToCloth`, `busket`, `cloth` 
        WHERE busketToCloth.clothId = $clothId AND busketToCloth.busketId = busket.id AND busket.userId = $userId AND busketToCloth.clothId = cloth.id;
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
        $basketToClothId = $row['BTCid'];
        $query = "
        DELETE FROM `busketToCloth` 
        WHERE id= $basketToClothId;
        ";

        $res = mysqli_query($this->connection, $query);
        
        return $row;
    }
}

$basketService = new basketService($connection);