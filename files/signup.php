<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="/css/log-sig.css" />
    <title>Регистрация</title>
    <style>
        /* Простой CSS для стилизации формы */
        form {
            max-width: 300px;
            margin: 0 auto;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 5px 0 20px 0;
            border: 1px solid #ddd;
        }
        button {
            padding: 10px;
        }
    </style>
</head>
<body>
   
<section>
   
    <form action="signup.php" method="post"> 
        <h2>Регистрация</h2>
        <div class="inputbox">
            <ion-icon name="person-outline"></ion-icon>
            <input type="text" name="username"  required>
            <label for="">Имя пользователя</label>
        </div>
        <div class="inputbox">
            <ion-icon name="lock-closed-outline"></ion-icon>
            <input type="password" name="password"  required>
            <label for="">Пароль</label>
        </div>
        <div class="inputbox">
            <ion-icon name="mail-outline"></ion-icon>
            <input type="email" name="email"  required>
            <label for="">Электронная почта</label>
        </div>
        <button type="submit">Зарегистрироваться</button> 
        <div class="register"> 
          <p>Уже зарегистрированы? <a href="login.php">Войти</a></p>
          </div>
    </form>
</section>
    
</body>
</html>

<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "immovables";
$conn = new mysqli($servername, $username, $password, $dbname);

// Обработка данных из формы регистрации
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Хэширование пароля
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Вставка данных в таблицу
    $sql = "INSERT INTO users (username, password_hash, email) VALUES ('$username', '$hash', '$email')";
    if ($conn->query($sql) === TRUE) {
        echo "Регистрация прошла успешно";
    } else {
        echo "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
