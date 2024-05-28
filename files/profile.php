<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Личный кабинет</title>
</head>
<body>
    
<a name="begin"></a>

<div id="main">

<!-- Шапка -->  
<div id="header">
<div id="banner">

<div id="welcome">
<img src="/images/logo.png" alt="Лого" id="logo" style="background-position: top; float: left; width: 11%; height: 72px; display: block; margin: -12px 0px 0px 27px;">
</a><? include "../inc/menu.php"; ?>
</div>

<div class="profile-container">
    <div class="profile">
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "immovables"; // Подключение к базе данных
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Если пользователь не аутентифицирован, перенаправить на страницу входа
                if (!isset($_SESSION['user_id'])) {
                    header("Location: login.php");
                    exit();
                }

                // Получение информации о пользователе из базы данных
                $user_id = $_SESSION['user_id'];
                // Получение информации о пользователе и его профиле из базы данных
                $stmt = $conn->prepare("SELECT U.*, P.* FROM users U LEFT JOIN user_profile P ON U.id = P.id WHERE U.id=?");
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    $row = $result->fetch_assoc();
                    // Отобразить информацию о пользователе и его профиле
                    echo "<p>ID пользователя: " . $row["id"] . "</p>";
                    echo "<h2>Личный кабинет</h2>";
                    echo "<p>Имя пользователя: " . $row["username"] . "</p>";
                    echo "<p>Email: " . $row["email"] . "</p>";
                    echo "<p>Роль: " . $row["role"] . "</p>";
                    echo "<p>Дата регистрации: " . $row["registration_date"] . "</p>";
                } else {
                    echo "Информация о пользователе не найдена";
                }

                // Добавляем кнопку выхода
                echo "<form action='logout.php' method='post'>";
                echo "<input type='submit' value='Выйти'>";
                echo "</form>";
                ?>
                
                
    </div>
</div>
</body>
</html>