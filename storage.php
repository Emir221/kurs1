<?php
            session_start(); ?>
<?php
include 'db.php';

$query = 'SELECT * FROM products';
$stmt = $pdo->query($query);
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Склад</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <nav>
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
    <div class="container">
        <h1 class="title">Склад продуктов</h1>
        <p class="subtitle">Отслеживайте наличие продуктов и обновляйте их количество</p>

        <!-- Таблица склада -->
        <table>
            <thead>
                <tr>
                    <th>Название продукта</th>
                    <th>Количество (грамм)</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Выводим данные о продуктах
                foreach ($products as $product) {
                    echo "<tr>
                            <td>{$product['name']}</td>
                            <td>{$product['quantity']}</td>
                          </tr>";
                }
                ?>
            </tbody>

        </table>

    </div>
<button class="button"><a class="button" href="http://127.0.0.1/openserver/phpmyadmin/sql.php?server=1&db=dostavka_salat&table=products&pos=0">Редактировать</a></button>

    <footer>
        &copy; Dostavka SalaT, 2024
    </footer>
</body>
</html>