<div class="menu">
    <div class="nav">
        <ul class="blue">
            <li class="blue"><a href="/">Главная</a></li>
            <li class="blue"><a href="#1">О нас</a></li>
            <li class="blue"><a href="../files/info-card.php" >Услуги</a></li>
            <?php
            if (isset($_SESSION['user_id'])) {
                echo '<li class="blue"><a href="../files/profile.php">Профиль</a></li>';
            } else {
                echo '<li class="blue"><a href="../files/login.php">Вход</a></li>';
            }
            ?>
        </ul>
    </div>
</div>
<br />