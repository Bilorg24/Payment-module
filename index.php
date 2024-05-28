<? session_start(); ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
  <title></title>
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta http-equiv="X-UA-Compatible" content="IE=9" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <link rel="stylesheet" type="text/css" href="css/catalog.css" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

</div>
</div>
<img src="images/banner.jpg" alt="Баннер" id="slidebanner">

<!-- Контейнер контента начало--> 
<div id="site_content">	

<div id="content">
<div class="content_item">
    <div class="">
        <h2>Квартиры которые мы предоставляем</h2>
    </div>
<? include "files/apartments_catalog.php"; ?> 



<div name="services-section" class="services-section">
        <h2>Наши услуги</h2>
        <div class="service-cards">
            <div class="service-card">
                <h3>Продажа недвижимости</h3>
                <p>Продажа выгодно, быстро и безопасно: вторичной, загородной, коммерческой недвижимости – под ваши цели и условия.</p>
            </div>

            <button class="apply-btn">Подать заявку</button>
        </div>

        <h2>Наши преимущества</h2>
        <div class="advantages-cards">
            <div class="advantage-card">
                <h3 class="advcard">В наличии покупатели с наличными и ипотечными средствами</h3>
                <p>База клиентов с 25 банков по М.О. и Москве</p>
            </div>
            <div class="advantage-card">
                <h3 class="advcard">Выход на сделку купли-продажи 2 недели от момента обращения</h3>
                <p>Мы гарантируем, что сделка купли-продажи будет заключена в течение 2 недель с момента обращения к нам. Мы обеспечим быстрое и эффективное проведение сделки, учитывая все ваши пожелания.</p>
            </div>
            <div class="advantage-card">
                <h3 class="advcard">Продажа по максимальной рыночной стоимости</h3>
                <p>Мы используем свой профессиональный опыт и знание рынка, чтобы обеспечить продажу вашей недвижимости по максимальной возможной рыночной стоимости.</p>
            </div>
            <div class="advantage-card">
                <h3 class="advcard">Полное юридическое сопровождение</h3>
                <p>Мы предоставляем полное юридическое сопровождение во всех этапах сделки, чтобы обеспечить ваше спокойствие и безопасность.</p>
            </div>
            <div class="advantage-card">
                <h3 class="advcard">Разберемся в сложных ситуациях</h3>
                <p>Наша команда специалистов поможет вам разобраться в любых сложных ситуациях, связанных с недвижимостью, включая оформление залога в банке, использование материнского капитала и другие вопросы.</p>
            </div>
        </div>
    </div>

<div class="about-section">
    <h2>О нас - Наши социальные сети</h2>
    <p>Доведем до результата Ваш квартирный вопрос! Наше агентство недвижимости "ProfAgent" профессионал в своей сфере. У нас уже более тысячи клиентов, которые довольны нашей работой и остались с нами для дальнейшего сотрудничества.</p>
    <p>Мы являемся для многих семейными риэлторами. Нас рекомендуют своим близким и зарабатывают вместе с нами получая проценты со сделки! Мы окажем помощь в решении жилищных вопросов любой сложности.</p>
    <p>Наша задача сэкономить Ваше время и выгодно провести сделку с недвижимостью, пока Вы занимаетесь своими делами.</p>
    
    <div class="social-icons">
        <h3>Это наши социальные сети</h3>
        <a href=""><img src="/images/telegram.png" alt=""></a>
        <a href=""><img src="/images/vk.png" alt=""></a>
        <a href=""><img src="/images/email.png" alt=""></a>
    </div>
    
    <div class="partner-logos">
        <h3>Это наши партнеры</h3>
        <img src="/images/btb.png" alt="логотип партнера 1">
        <img src="/images/cber.png" alt="логотип партнера 2">
        <img src="/images/tinkof.jpeg" alt="логотип партнера 3">
        <img src="/images/alfa.png" alt="логотип партнера 4">
    </div>
</div>



 
<? include "inc/footer.php"; ?>
  
</body>
</html>
