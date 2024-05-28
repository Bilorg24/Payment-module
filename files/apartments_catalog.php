<form id="filterForm" method="get" action="">
<div class="form-room">
    <label for="rooms">Количество комнат:</label>
    <div class="room-checkboxes">
      <input type="checkbox" id="room1" name="rooms[]" value="1">
      <label for="room1">1</label>
      <input type="checkbox" id="room2" name="rooms[]" value="2">
      <label for="room2">2</label>
      <input type="checkbox" id="room3" name="rooms[]" value="3">
      <label for="room3">3</label>
      <input type="checkbox" id="room4" name="rooms[]" value="4">
      <label for="room4">4</label>
      <input type="checkbox" id="room5plus" name="rooms[]" value="5+">
      <label for="room5plus">5+</label>
    </div>
  </div>
  
  <div class="form-realty">
    <label for="building_type">Тип новостройки:</label>
    <div class="realty-checkboxes">
        <div class="dropdown">
            <div id="dropdown-content" class="dropdown-content">
                <input type="checkbox" id="building_type1" name="building_type[]" value="новостройка">
                <label for="building_type1">Новостройка</label>
                <input type="checkbox" id="building_type2" name="building_type[]" value="пентхаус">
                <label for="building_type2">Пентхаус</label>
                <input type="checkbox" id="building_type3" name="building_type[]" value="студия">
                <label for="building_type3">Студия</label>
                <input type="checkbox" id="building_type4" name="building_type[]" value="лофт">
                <label for="building_type4">Лофт</label>
                <input type="checkbox" id="building_type5" name="building_type[]" value="эксклюзивные">
                <label for="building_type5">Эксклюзивные</label>
                <input type="checkbox" id="building_type6" name="building_type[]" value="бюджетные">
                <label for="building_type6">Бюджетные</label>
            </div>
        </div>
    </div>
</div>

  <div class="price-inputs">
    <div class="price-label">
      <label for="price_from">Цена, ₽</label>
    </div>
    <div class="form-group">
      <input type="text" name="price_from" id="price_from" placeholder="от">
      <input type="text" name="price_to" id="price_to" placeholder="до">
    </div>
  </div>
  <div class="form-group" style="margin-bottom: 20px;">
    <label for="area" style="display: block; font-weight: bold;">Площадь:</label>
    <div>
      <input type="text" name="area_from" id="area_from" placeholder="от">
      <input type="text" name="area_to" id="area_to" placeholder="до">
    </div>
  </div>
  <input type="submit" id="applyFiltersButton" value="Применить фильтры">
  <input type="button" value="Очистить фильтры" onclick="clearFilters()">
</form>

<div id="selectedOptions" style=""></div>
<!-- Выпадающее меню фильтра
<script>
// Получаем кнопку и выпадающее меню
var dropdownBtn = document.getElementById("dropdown-btn");
var dropdownContent = document.getElementById("dropdown-content");

// Обработчик события клика по кнопке
dropdownBtn.onclick = function(event) {
  event.preventDefault(); // предотвращаем действие по умолчанию (например, переход при клике на ссылку)
  if (dropdownContent.style.display === "block") {
    dropdownContent.style.display = "none";
  } else {
    // Перед открытием меню убедимся, что все его элементы отобразятся вертикально
    dropdownContent.style.display = "block";
    dropdownContent.style.flexDirection = "column";
    // Добавим отступы между элементами списка
    var dropdownItems = dropdownContent.querySelectorAll("label");
    dropdownItems.forEach(function(item) {
      item.style.marginBottom = "5px";
    });
  }
}

// Обработчик события клика за пределами блока
window.onclick = function(event) {
  // Если клик был за пределами блока, скрываем выпадающее меню (если не кликнули на сам блок или на элементы внутри него)
  if (!event.target.matches('.dropdown-btn') && !event.target.closest('.dropdown-content')) {
    dropdownContent.style.display = 'none';
  }
}

// Обработчик события изменения выбранных опций
dropdownContent.addEventListener('change', function(event) {
  var selectedOptions = dropdownContent.querySelectorAll('input[type="checkbox"]:checked');
});
</script> -->

<style>
.dropdown-btn {
    background-color: #f1f1f1;
    color: black;
    padding: 10px;
    border: none;
    cursor: pointer;
    
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    background-color: #f9f9f9;
    min-width: 160px;
    padding: 12px 16px;
    z-index: 1;

}</style>





<script>
// Функция для записи выбранных фильтров в URL
var updateSelectedOptions = function() {
    var selectedRooms = Array.from(document.querySelectorAll('input[name="rooms[]"]:checked')).map(function(el) {
        return el.value;
    });
    var selectedBuildingTypes = Array.from(document.querySelectorAll('input[name="building_type[]"]:checked')).map(function(el) {
        return el.value;
    });

    // Создаем новый URL с выбранными параметрами
    var selectedParams = new URLSearchParams();
    selectedRooms.forEach(function(room) {
        selectedParams.append('rooms[]', room);
    });
    selectedBuildingTypes.forEach(function(type) {
        selectedParams.append('building_type[]', type);
    });

    // Обновляем URL с учетом выбранных параметров
    var newUrl = window.location.pathname + '?' + selectedParams.toString();
    window.history.pushState({ path: newUrl }, '', newUrl);

    // Перезагрузка страницы с новым URL для применения фильтров
    window.location.reload();
};

// Обработка фильтров
document.addEventListener('DOMContentLoaded', function() {
    // Получаем значения из GET-параметров
    const urlParams = new URLSearchParams(window.location.search);
    const rooms = urlParams.getAll('rooms[]');
    const buildingType = urlParams.getAll('building_type[]');
    const priceFrom = urlParams.get('price_from');
    const priceTo = urlParams.get('price_to');
    const areaFrom = urlParams.get('area_from');
    const areaTo = urlParams.get('area_to');

    // Применяем выбранные значения к фильтрам
    rooms.forEach(function(room) {
        document.getElementById('room' + room).checked = true;
    });

    buildingType.forEach(function(type) {
        document.getElementById('building_type' + type).checked = true;
    });
});

// Очистка фильтров
function clearFilters() {
    document.querySelector('form').reset();
    // Перезагрузка страницы без фильтров
    window.location.href = window.location.pathname;
}
</script>

<script>
  // Сохранение выбранных фильтров
  document.addEventListener('DOMContentLoaded', function() {
    // Получаем значения из GET-параметров
    const urlParams = new URLSearchParams(window.location.search);
    const rooms = urlParams.get('rooms');
    const buildingType = urlParams.get('building_type');
    const priceFrom = urlParams.get('price_from');
    const priceTo = urlParams.get('price_to');
    const area = urlParams.get('area');
    // Применяем выбранные значения к фильтрам
    document.getElementById('rooms').value = rooms || '';
    document.getElementById('building_type').value = buildingType || '';
    document.getElementById('price_from').value = priceFrom || '';
    document.getElementById('price_to').value = priceTo || '';
    document.getElementById('area').value = area || '';
  });

  // Очистка фильтров
  function clearFilters() {
    // Очищаем все поля формы и перезагружаем страницу без фильтров
    document.querySelector('form').reset();
    window.location.href = window.location.pathname;
  }
</script>


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

// Запрос к базе данных для извлечения информации о квартирах
$sql = "SELECT * FROM apartments";
$result = $conn->query($sql);

// Обработка фильтров
$rooms = isset($_GET['rooms']) ? $_GET['rooms'] : [];
$building_type = isset($_GET['building_type']) ? $_GET['building_type'] : [];
$price_from = isset($_GET['price_from']) ? $_GET['price_from'] : "";
$price_to = isset($_GET['price_to']) ? $_GET['price_to'] : "";
$area = isset($_GET['area']) ? $_GET['area'] : "";

// Создание базового запроса
$sql = "SELECT * FROM apartments";

// Формирование условий WHERE на основе выбранных фильтров
$whereConditions = array();
if (!empty($rooms)) {
    $roomsFilter = implode("','", $rooms);
    $whereConditions[] = "rooms IN ('$roomsFilter')";
}
if (!empty($building_type)) {
    $buildingTypeFilter = implode("','", $building_type);
    $whereConditions[] = "building_type IN ('$buildingTypeFilter')";
}
if (!empty($price_from) && !empty($price_to)) {
    $whereConditions[] = "price BETWEEN $price_from AND $price_to";
}
if (!empty($area)) {
    $whereConditions[] = "area >= $area";
}
// Соединяем условия WHERE через AND
if (!empty($whereConditions)) {
    $whereClause = " WHERE " . implode(" AND ", $whereConditions);
    $sql .= $whereClause;
}
// Выполнение запроса к базе данных
$result = $conn->query($sql);
// Печать результатов
while ($row = $result->fetch_assoc()) {
    // обработка результатов
}
// Фильтр по количеству комнат
if (!empty($rooms)) {
  $room_filter = implode("','", $rooms); // Преобразуем массив в строку для использования в запросе
  $where .= " AND rooms IN ('$room_filter')";
}
// Фильтр по типу новостройки
$building_type = isset($_GET['building_type']) ? $_GET['building_type'] : [];
if (!empty($building_type)) {
  $building_type_filter = implode("','", $building_type); // Преобразуем массив в строку для использования в запросе
  $where .= " AND building_type IN ('$building_type_filter')";
}
// Фильтр по цене
if (!empty($price_from) && !empty($price_to)) {
  $where .= " AND price BETWEEN $price_from AND $price_to";
}
// Фильтр по площади
if (!empty($area_from)) {
  $where .= " AND area >= $area_from";
}
if (!empty($area_to)) {
  $where .= " AND area <= $area_to";
}

// Измененный запрос на извлечение информации о квартирах, чтобы включить условие WHERE
$sql = "SELECT * FROM apartments WHERE 1 $where";
$result = $conn->query($sql);

// Отображение каталога квартир
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
      echo "<a href='apartment.php?id=" . $row["id"] . "'>";
      echo "<div class='apartment'>";
      echo "<img src='" . $row["image_url"] . "' alt='Квартира' class='apartment-image'>";
      echo "<div class='details'>";
      echo "<h2>" . $row["title"] . "</h2>";
      echo "<p class='building-type'>" . $row["building_type"] . "</p>";
      echo "<p class='address'>Адрес: " . $row["address"] . "</p>";
      echo "<button class='show-phone' data-phone='" . $row["owner_phone"] . "'>Показать телефон</button>";
      echo "</div>";
      
      echo "<div class='prices'>";
      $formatted_price = number_format($row["price"], 0, '', ' ');
      $price_per_sqm = number_format($row["price"] / $row["area"], 0, '', ' ');
      echo "<p class='price'> " . $formatted_price . " ₽</p>";
      echo "<p class='price-per-square'>Цена за кв.м: " . $price_per_sqm . " ₽/м²</p>";
      echo "</div>";

      echo "</div>";
      echo "</a>";
  }
} else {
  echo "Нет доступных квартир";
}

// Закрытие соединения с базой данных
$conn->close();
?>

<script>
  //Скрипт  на показ телефона
document.addEventListener('DOMContentLoaded', function() {
    var buttons = document.getElementsByClassName('show-phone');
    Array.from(buttons).forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault(); // Предотвращаем переход

            var phoneNumber = this.getAttribute('data-phone');
            this.textContent = phoneNumber; // Заменяем текст кнопки на номер телефона
            this.classList.add('showing-phone'); // Добавляем класс для стилей номера телефона
        });
    });
});

</script>