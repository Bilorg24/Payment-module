<?php
session_start(); // Начало сессии

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "immovables";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Подключение к базе данных успешно";
} catch(PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
}
?>