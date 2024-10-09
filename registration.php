<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="styles/index.css">
</head>

<body>
    <?php
    require_once ('./components/navbar.php');
    ?>
    <form action="" method="POST">
        <input type="text" placeholder="Введите логин" name="login" required><br>
        <input type="text" placeholder="Введите имя" name="name" required><br>
        <input type="text" placeholder="Введите почту" name="email" required><br>
        <input type="text" placeholder="Введите телефон" name="phone" required><br>
        <input type="password" placeholder="Введите пароль" name="password" required><br>
        <button> Зарегистрироваться </button>
    </form>
</body>

</html>

<?php
include_once ('./api/auth/authController.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pass = md5($_POST['password']);

    $user = $authController->register(
        $_POST['login'],
        $_POST['name'],
        $_POST['email'],
        $_POST['phone'],
        $pass
    );
    $_SESSION['userId'] = $user['userId'];
    $_SESSION['login'] = $user['login'];
    $_SESSION['name'] = $user['name'];
    $_SESSION['role'] = $user['role'];
    $_SESSION['phone'] = $user['phone'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['basketId'] = $user['basketId'];
    $_SESSION['favoriteId'] = $user['favoriteId'];
}
?>