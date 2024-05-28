<?php
// Конфигурация подключения к базе данных
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "immovables";

// Создаем соединение с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем соединение
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}
?>