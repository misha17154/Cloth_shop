<?php
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: http://localhost/index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        require_once('./components/navbar.php');
    ?>
    <form action="">
        <button name="logout" value="1">Выйти</button>
    </form>
</body>

</html>