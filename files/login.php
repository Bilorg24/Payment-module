<?php
session_start(); // Начать сессию

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    // Подключение к базе данных
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "immovables";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Получение хэшированного пароля из базы данных
    $sql = "SELECT id, password_hash FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password_hash"])) {
            $_SESSION['user_id'] = $row['id'];  // Сохранение ID пользователя в сессии
            header("Location: profile.php");  // Перенаправление на страницу профиля
            exit();
        } else {
            $error = "Неправильное имя пользователя или пароль";
        }
    } else {
        $error = "Неправильное имя пользователя или пароль";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Вход</title>
    <link rel="stylesheet" type="text/css" href="/css/log-sig.css" />
</head>
<body>

<section>
    <form action="login.php" method="post">
        <h1>Login</h1>
        <div class="inputbox">
            <ion-icon name="mail-outline"></ion-icon>
            <input type="text" name="username" required>
            <label for="">Имя пользователя</label>
        </div>
        <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" name="password" required>
            <label for="">Пароль</label>
        </div>
        <div class="forget">
            <label for=""><input type="checkbox">Запомнить меня</label>
            <a href="#">Забыли пароль</a>
        </div>
        <button type="submit">Войти</button>
        <div class="error"><?php if(isset($error)) { echo $error; } ?></div>
        <div class="register">
            <p>Еще не зарегистрированы? <a href="signup.php">Зарегистрироваться</a></p>
            <a href="/profile.php">Перейти в кабинет</a>
        </div>
    </form>
</section>

</body>
</html>

