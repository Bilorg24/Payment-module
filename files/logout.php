<?php
session_start(); // Начать сессию
session_unset(); // Очистить все переменные сессии
session_destroy(); // Уничтожить сессию
header("Location: login.php"); // Перенаправить на страницу входа
exit();
?>