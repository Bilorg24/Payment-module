<?php
// Подключение к базе данных
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "immovables";

$conn = new mysqli($servername, $username, $password, $dbname);

// Получение данных из формы
$apartment_number = $_POST['apartment_number'];
$rooms = $_POST['rooms'];
$area = $_POST['area'];
$floor = $_POST['floor'];
$price = $_POST['price'];
$city = $_POST['city'];
$address = $_POST['address'];
$title = $_POST['title'];
$description = $_POST['description'];

// Сохранение изображения на сервере
$image_name = $_FILES['image']['name'];
$image_tmp_name = $_FILES['image']['tmp_name'];
$image_path = 'http://akursowai/uploads/' . $image_name;
move_uploaded_file($image_tmp_name, $image_path);

// Добавление данных в базу данных
$sql = "INSERT INTO apartments (apartment_number, rooms, area, floor, price, city, address, image_url, title, description) 
        VALUES ('$apartment_number', '$rooms', '$area', '$floor', '$price', '$city', '$address', '$image_path', '$title', '$description')";

if ($conn->query($sql) === TRUE) {
  echo "Данные успешно добавлены в базу данных";
} else {
  echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>