<?php
require_once ('./api/db.php');
class favoriteService
{
    protected $connection;
    function __construct($connection)
    {
        $this->connection = $connection;
    }
    // Получить все
    public function getAll()
    {
        // username, вся инфа о штанах или о другой одежде которая ему принадлежит
        // vasya футболка л заголовок хедер
        // vasya штаны с загловок хедер
        // петя футболка л заголовок хедер
        $query = "
        SELECT u.name, c.type, c.size, c.color, c.brand, c.header, c.description, c.cost 
        FROM `users` as u, `favorite` as f, `favoriteToCloth` as ftc, `cloth` as c 
        WHERE u.id = f.userId AND f.id = ftc.favoriteId AND ftc.clothId = c.id;
        ";

        $res = mysqli_query($this->connection, $query);

        $favorites = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($favorites, $row);
                // print_r($row);
                // echo "<br>";
            }
        }

        return $favorites;
    }
    // Получить один
    public function getOne($userId)
    {
        $query = "
        SELECT u.name, c.type, c.size, c.color, c.brand, c.header, c.description, c.cost 
        FROM `users` as u, `favorite` as f, `favoriteToCloth` as ftc, `cloth` as c 
        WHERE u.id = f.userId AND f.id = ftc.favoriteId AND ftc.clothId = c.id AND u.id = $userId;
        ";

        $res = mysqli_query($this->connection, $query);

        $userFavorite = [];

        if ($res->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                array_push($userFavorite, $row);
                // print_r($row);
                // echo "<br>";
            }
        }
        return $userFavorite;
    }
    // Добавить один
    public function addOne($favoriteId, $clothId)
    {
        // Проверяем, есть ли уже такая запись
        $query = "
            SELECT * 
            FROM `favoriteToCloth`
            WHERE 
            `favoriteId` = $favoriteId AND
            `clothId` = $clothId";

        $res = mysqli_query($this->connection, $query);

        if ($res->num_rows > 0) {
            return ['error' => "Ошибка! Товар уже был добавлен в избранное!"];
        }

        // Добавляем продукт в избраное
        $query = "
        INSERT INTO `favoriteToCloth`(`favoriteId`, `clothId`) 
        VALUES ($favoriteId, $clothId)
        ";

        $res = mysqli_query($this->connection, $query);

        // делаем запрос на получение той строки, которую мы ТОЛЬКО ЧТО добавили
        if ($res == 1) {
            $query = "
            SELECT * 
            FROM `favoriteToCloth`
            WHERE 
            `favoriteId` = $favoriteId AND
            `clothId` = $clothId;";

            $res = mysqli_query($this->connection, $query);

            $row = [];
            if ($res->num_rows > 0) {
                $row = mysqli_fetch_assoc($res);
            }
            return $row;
        }
    }
    // Обновить один
    // public function updateOne($busketToClothId, $newCount)
    // {
    //     $query = "
    //     UPDATE `busketToCloth` 
    //     SET `count`= $newCount
    //     WHERE id= $busketToClothId;
    //     ";

    //     $res = mysqli_query($this->connection, $query);
    //     // print_r($res);

    //     // Проверка, что запрос выполнился, и строка с новыми параметрами существует
    //     $query = "
    //     SELECT *
    //     FROM `busketToCloth`
    //     WHERE id = $busketToClothId AND `count`= $newCount
    //     ";
    //     $res = mysqli_query($this->connection, $query);

    //     if ($res->num_rows > 0) {
    //         $row = mysqli_fetch_assoc($res);
    //         return $row;
    //     } else {
    //         return [
    //             'error' => "Ошибка при обновлении данных!"
    //         ];
    //     }
    // }
    // Удалить один
    public function deleteOne($userId, $clothId)
    {
        // Получаем одежду которую удаляем и id записи в busketToCloth (BTCid)
        $query = "
        SELECT ftc.id as FTCid, ftc.favoriteId, ftc.clothId FROM `users` as u, `favorite` as f, `favoriteToCloth` as ftc, `cloth` as c WHERE ftc.clothId = c.id AND ftc.favoriteId = f.id AND u.id = f.userId AND u.id = $userId AND c.id = $clothId;
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
        $favoriteToClothId = $row['FTCid'];
        $query = "
        DELETE FROM `favoriteToCloth` 
        WHERE id= $favoriteToClothId;
        ";

        $res = mysqli_query($this->connection, $query);
        
        return $row;
    }
}

$usersService = new favoriteService($connection);