<?php
// Подключаем файл для подключения к базе данных
require_once 'connect.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Проверяем, что поля не пустые
    if (!empty($username) && !empty($password)) {
        // Проверка наличия пользователя в базе данных
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Если пользователь найден, проверяем пароль
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            header("Location: index.php");  // Перенаправление на главную страницу
            exit;
        } else {
            $error = 'Неверные имя пользователя или пароль.';
        }
    } else {
        $error = 'Пожалуйста, заполните все поля.';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="auth-container">
        <h1>Авторизация</h1>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" name="username" id="username" placeholder="Введите имя пользователя" required>
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" placeholder="Введите пароль" required>
            </div>

            <button type="submit" class="submit-btn">Войти</button>

            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
        </form>
        <p>Нет аккаунта? <a href="register.php">Зарегистрироваться</a></p>
    </div>
</body>
</html>