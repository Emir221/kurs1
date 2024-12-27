<?php
            session_start(); ?>
<?php
// Подключаем базу данных или получаем список блюд из другой части кода
// Пример массива блюд
$dishes = [
    ['id' => 1, 'name' => 'Пицца Маргарита', 'image' => 'images/margarita.jpg', 'description' => 'Тесто, томатный соус, сыр, помидоры'],
    ['id' => 2, 'name' => 'Пицца Цезарь', 'image' => 'images/caesar_pizza.jpg', 'description' => 'Тесто, курица, салат Цезарь, сыр'],
    ['id' => 3, 'name' => 'Ролл Цезарь с курицей', 'image' => 'images/chicken_roll.jpg', 'description' => 'Нори, курица, соус, помидоры, салат Айсберг']
];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список блюд</title>
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
        <h1 class="title">Список блюд</h1>
        
        <div class="menu">
            <?php foreach ($dishes as $dish): ?>
                <div class="dish-card">
                    <img src="<?php echo htmlspecialchars($dish['image']); ?>" alt="<?php echo htmlspecialchars($dish['name']); ?>">
                    <h3><?php echo htmlspecialchars($dish['name']); ?></h3>
                    <p>Состав: <?php echo htmlspecialchars($dish['description']); ?></p>
                    <form method="POST" action="prepare_dish.php">
                        <input type="hidden" name="dish_id" value="<?php echo $dish['id']; ?>">
                        <button type="submit">Готовить</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer>
        &copy; Dostavka SalaT, 2024
    </footer>
</body>
</html>