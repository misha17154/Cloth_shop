<?php
require_once ('./api/db.php');
class authService
{
    protected $connection;
    function __construct($connection)
    {
        $this->connection = $connection;
    }
    // Получить все
    public function register($login, $name, $email, $phone, $password)
    {
        // ошибку пишем в формате ['error' => 'текст ошибки'];
        // Проверить логин есть ли такой уже в бд?
        $query = "
        SELECT *
        FROM `users`
        WHERE users.login = $login
        ";

        $res = mysqli_query($this->connection, $query);
        if ($res->num_rows > 0) {
            return [
                'error' => "Ошибка! Пользователь с таким логином уже существует!"
            ];
        }

        // Проверить почту есть ли такой уже в бд?
        $query = "
        SELECT *
        FROM `users`
        WHERE users.email = $email
        ";

        $res = mysqli_query($this->connection, $query);
        if ($res->num_rows > 0) {
            return [
                'error' => "Ошибка! Пользователь с таким email уже существует!"
            ];
        }
        // Проверить телефон есть ли такой уже в бд?
        $query = "
        SELECT *
        FROM `users`
        WHERE users.phone = $phone
        ";

        $res = mysqli_query($this->connection, $query);
        if ($res->num_rows > 0) {
            return [
                'error' => "Ошибка! Пользователь с таким телефоном уже существует!"
            ];
        }

        // Добавить пользователя в базу данных
        $query = "
        INSERT INTO `users`(`login`, `pass`, `name`, `phone`, `email`) 
        VALUES ('$login','$password','$name','$phone','$email')
        ";
        $res = mysqli_query($this->connection, $query);

        // Получить данные только что добавленного пользователя для создания корзины и избранного
        $query = "
        SELECT `id`
        FROM `users`
        WHERE users.login = '$login'
        ";

        $res = mysqli_query($this->connection, $query);
        if ($res->num_rows == 0) {
            return [
                'error' => "Ошибка! Пользователь не был добавлен!"
            ];
        }


        // Записать в переменную id айдишник только что добавленного юзера
        $row = mysqli_fetch_assoc($res);
        $id = $row['id'];

        // Создать корзину и избранное
        $query = "
        INSERT INTO `busket`(`userId`) 
        VALUES ($id)
        ";
        $res = mysqli_query($this->connection, $query);

        $query = "
        INSERT INTO `favorite`(`userId`) 
        VALUES ($id)
        ";
        $res = mysqli_query($this->connection, $query);
        // Получить все данные пользователя + корзины + избранного и вернуть на фронтенд
        $query = "
        SELECT u.id AS 'userId', u.login, u.pass, u.name, u.role, u.phone, u.email, b.id AS 'basketId', f.id AS 'favoriteId'
        FROM `users` AS u, `busket` AS b, `favorite` AS f
        WHERE u.id = $id AND b.userId = u.id AND f.userId = u.id
        ";
        $res = mysqli_query($this->connection, $query);
        $res = mysqli_fetch_assoc($res);
        // $res =  ['name' => 'Vasya446' ...]

        // возвращение пользователя
        return $res;
    }

    public function login($login, $password)
    {
        // $pass = md5($password);
        // Получить все данные пользователя + корзины + избранного и вернуть на фронтенд
        $query = "
        SELECT u.id AS 'userId', u.login, u.pass, u.name, u.role, u.phone, u.email, b.id AS 'basketId', f.id AS 'favoriteId'
        FROM `users` AS u, `busket` AS b, `favorite` AS f
        WHERE u.login = '$login' AND u.pass = '$password' AND b.userId = u.id AND f.userId = u.id
        ";
        $res = mysqli_query($this->connection, $query);
        if ($res->num_rows == 0) {
            return [
                'error' => "Ошибка! Неверный пароль или логин!"
            ];
        }
        $res = mysqli_fetch_assoc($res);
        // $res =  ['name' => 'Vasya446' ...]

        // возвращение пользователя
        return $res;
    }
}

$authService = new authService($connection);