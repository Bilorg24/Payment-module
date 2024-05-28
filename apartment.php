<? session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/catalog.css" />
</head>
<body>
<a name="begin"></a>

<div id="main">

<!-- Шапка -->  
<div id="header">
<div id="banner">

<div id="welcome">
<img src="images/logo.png" alt="Лого" id="logo" style="background-position: top; float: left; width: 11%; height: 72px; display: block; margin: -12px 0px 0px 27px;">
</a><? include "inc/menu.php"; ?>
</div>

<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "immovables";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Получение id квартиры из параметра запроса
$id = $_GET['id'];

// Запрос к базе данных для извлечения информации о конкретной квартире
$sql = "SELECT * FROM apartments WHERE id = $id";
$result = $conn->query($sql);



if ($result->num_rows > 0) {  
  $row = $result->fetch_assoc();

  // Отображение информации о квартире
  echo "<div class='info'>";
  echo "<h2>" . $row["title"] . "</h2>";
  echo "<p>" . $row["description"] . "</p>";
  echo "<p class='area'>Площадь: " . $row["area"] . " кв.м</p>";
  echo "<p class='rooms'>Количество комнат: " . $row["rooms"] . "</p>";
  echo "<p class='floor'>Этаж: " . $row["floor"] . "</p>";
  echo "<p class='price'>Цена: " . $row["price"] . " руб</p>";
  echo "<p class='address'>Адрес: " . $row["address"] . ", " . $row["city"] . "</p>";

  // Запрос к базе данных для извлечения дополнительной информации
  $additional_info_sql = "SELECT * FROM apartment_additional_details WHERE apartment_id = $id";
  $additional_info_result = $conn->query($additional_info_sql);

  if ($additional_info_result->num_rows > 0) {
    $additional_row = $additional_info_result->fetch_assoc();
    echo "<div class='additional-info'>";
    echo "<h3>Дополнительная информация:</h3>";
    echo "<p>" . $additional_row["additional_description"] . "</p>";
    echo "<p>" . $additional_row["additional_info"] . "</p>";
    echo "</div>";
  } else {
    echo "<p class='no-additional-info'>Дополнительная информация не найдена</p>";
  }

  echo "</div>"; // закрытие div с классом info
} else {
  echo "<p class='not-found'>Квартира не найдена</p>";
}

// Закрытие соединения с базой данных

?>
<?php


// Запрос для получения основной информации о квартире
$query = "SELECT image_url FROM apartments WHERE id = $id";
$result = $conn->query($query);

if ($result->num_rows > 0) {  
  $row = $result->fetch_assoc();
  $image_url = $row["image_url"]; // Главное изображение

  echo "<div class='gallery-container'>";
  echo "<div class='main-image'>";
  echo "<img id='mainImg' src='" . $image_url . "' alt='Главное изображение квартиры'>";
  echo "</div>";

  echo "<div class='gallery-thumbnails'>";
  echo "<div class='thumbnail' onclick='showMainImage(\"" . $image_url . "\")'>";
  echo "<img src='" . $image_url . "'>";
  echo "</div>";

  // Запрос для получения URL дополнительных изображений
  $additional_images_sql = "SELECT image_url FROM apartment_images WHERE apartment_id = $id";
  $additional_images_result = $conn->query($additional_images_sql);

  if ($additional_images_result->num_rows > 0) {
    while($additional_image_row = $additional_images_result->fetch_assoc()) {
      echo "<div class='thumbnail' onclick='showMainImage(\"" . $additional_image_row['image_url'] . "\")'>";
      echo "<img src='" . $additional_image_row['image_url'] . "'>";
      echo "</div>";
    }
  } else {
    echo "<p class='no-images'>Дополнительные изображения не найдены</p>";
  }
  echo "</div>"; // закрываем контейнер для маленьких изображений
  echo "</div>"; // закрываем контейнер для всей галереи
}

echo "<script>
function showMainImage(imageUrl) {
  document.getElementById('mainImg').src = imageUrl;
}
</script>";
?>




<style>
/* Стили для главного изображения */
.main-image img {
  max-width: 100%;
}

/* Стили для миниатюр изображений */
.gallery-thumbnails {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
}

.thumbnail {
  margin: 5px;
  cursor: pointer;
}

.thumbnail img {
  max-width: 100px;
  max-height: 75px;
}

/* Стили для кнопок навигации */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
}

.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.prev:hover, .next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}
</style>




</div>
</div>
</body>
</html>


