<footer>
    <div class="footer-info">
        <h3>Контактная информация</h3>
        <p>Наш адрес: ул. Примерная, 123</p>
        <p>Телефон: +7 (123) 456-78-90</p>
        <p>Email: info@immovables.ru</p>
    </div>

    <div class="footer-links">
        <h3>Полезные ссылки</h3>
        <ul>
            <li><a href="about_us.php">О нас</a></li>
            <li><a href="services.php">Услуги</a></li>
            <li><a href="properties.php">Недвижимость</a></li>
            <li><a href="contact.php">Контакты</a></li>
        </ul>
    </div>

    <div class="footer-social">
        <h3>Мы в социальных сетях</h3>
        <a >Facebook</a>
        <a >Twitter</a>
        <a >Instagram</a>
    </div>
</footer>

<style>
footer {
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    width: 940px;
    margin: 0 auto; 
}

.footer-info, .footer-links, .footer-social {
    flex: 1;
}

.footer-links ul {
    list-style-type: none;
    padding: 0;
}

.footer-links li {
    margin-bottom: 5px;
}

.footer-social a {
    display: block;
    margin-top: 5px;
    text-decoration: none;
}
</style>
