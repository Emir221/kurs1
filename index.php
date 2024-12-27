<?php
            session_start(); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добро пожаловать в Dostavka SalaT</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav class="main-nav">
        <ul>
            <li><a href="index.php">Главная</a></li>
            <li><a href="dishes.php">Блюда</a></li>
            <li><a href="storage.php">Склад</a></li>
            <?php
            session_start();
            if (isset($_SESSION['user_id'])) {
            echo "Добро пожаловать, " . htmlspecialchars($_SESSION['username']);
            
            echo "<a href='logout.php'>Выйти</a>";
            } else {
            echo "<a href='login.php'>Войти</a> | <a href='register.php'>Зарегистрироваться</a>";
            }
        ?>
        </ul>
        
    </nav>

    <header class="hero-container">
        <div class="hero-content">
            <h1>Добро пожаловать в <span>Dostavka SalaT</span></h1>
            <p>Ваши любимые блюда на заказ с доставкой прямо к вам!</p>
            <div class="hero-buttons">
                <a href="dishes.php" class="button">Посмотреть блюда</a>
                <a href="storage.php" class="button">Склад продуктов</a>
            </div>
        </div>

    </header>

    <section class="about-section">
        <div class="container">
            <h2>О нас</h2>
            <p>Мы предлагаем широкий выбор вкусных блюд, приготовленных с любовью и только из свежих продуктов. Заказывайте любимые блюда прямо с нашего сайта и наслаждайтесь удобством доставки.</p>
        </div>
    </section>

    <section class="featured-dishes-container">
        <div class="container">
            <h2>Популярные блюда</h2>
            <div class="dish-cards-container">
                <div class="dish-card">
                    <img src="images/margarita.jpg" alt="Пицца Маргарита">
                    <h3>Пицца Маргарита</h3>
                    <p>Тесто, томатный соус, сыр</p>
                    <a href="dishes.php" class="button">Подробнее</a>
                </div>
                <div class="dish-card">
                    <img src="images/caesar_pizza.jpg" alt="Пицца Цезарь">
                    <h3>Пицца Цезарь</h3>
                    <p>Тесто, курица, салат Цезарь, сыр</p>
                    <a href="dishes.php" class="button">Подробнее</a>
                </div>
                <div class="dish-card">
                    <img src="images/chicken_roll.jpg" alt="Ролл Цезарь с курицей">
                    <h3>Ролл Цезарь с курицей</h3>
                    <p>Тортилья, курица, соус, овощи</p>
                    <a href="dishes.php" class="button">Подробнее</a>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer">
        &copy; Dostavka SalaT, 2024
    </footer>
</body>
</html>