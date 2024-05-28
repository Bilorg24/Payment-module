<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/css/style.css" />
  <link rel="stylesheet" type="text/css" href="/css/catalog.css" />
    <title>Покупка услуг</title>
    <script>
    function handlePurchase(serviceId) {
        // Проверяем, есть ли идентификатор пользователя
        if (<?php echo isset($_SESSION['user_id']) ? 'true' : 'false'; ?>) {
            // Если пользователь аутентифицирован, перенаправляем на страницу оплаты
            window.location.href = '/files/card/payment-form.php?serviceId=' + serviceId;
        } else {
            // Если пользователя не аутентифицирован, перенаправляем на страницу входа
            window.location.href = '/files/login.php';
        }
    }
</script>
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

<h1 class="page-title">Услуги риэлтора от агентства недвижимости</h1>
<p class="page-description">Мы предлагаем широкий спектр услуг по недвижимости, включая:</p>
<ul class="services-list">
    <li class="service-item">Покупка и продажа жилой недвижимости
        <button class="purchase-button" onclick="handlePurchase(1)">Приобрести</button>
    </li>
    <li class="service-item">Аренда жилой и коммерческой недвижимости
        <button class="purchase-button" onclick="handlePurchase(2)">Приобрести</button>
    </li>
    <li class="service-item">Консультации по ипотеке и кредитованию
        <button class="purchase-button" onclick="handlePurchase(3)">Приобрести</button>
    </li>
    <li class="service-item">Юридическое сопровождение сделок с недвижимостью
        <button class="purchase-button" onclick="handlePurchase(4)">Приобрести</button>
    </li>
</ul>
    </div>
</div>
<style>

</style>
</body>
</html>