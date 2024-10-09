<?php
session_start();
?>
<style>
    nav#navbar {
        width: 100%;
        background-color: blue;
    }

    ul#navbarLinks {
        display: flex;
        justify-content: center;
        list-style: none;
    }

    ul#navbarLinks li {
        padding: 20px;
        max-width: 200px;
        width: 100%;
        color: white;
        font-size: 24px;
    }

    ul#navbarLinks li a {
        color: white;
        text-decoration: none;
    }
</style>

<nav id="navbar">
    <ul id="navbarLinks">
        <li> <a href="index.php"> Главная </a> </li>
        <li> <a href="store.php"> Каталог </a> </li>
        <li> <a href="basket.php"> Корзина </a> </li>
        <li> <a href="#"> Избранное </a> </li>
        <?php
        if ($_SESSION['isAuth'] === true) {
            $name = $_SESSION['name'];
            echo "
            <li> <a href='profile.php'> $name </a> </li>
            ";
            if ($_SESSION['role'] === 'admin'){
                echo "
                <li> <a href='orders.php'> Заказы </a> </li>
                ";
            }
        } else {
            echo "
            <li> <a href='login.php'> Вход </a> </li>
            <li> <a href='registration.php'> Регистрация </a> </li>
            ";
        }
        ?>
    </ul>
</nav>