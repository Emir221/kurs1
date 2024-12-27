<?php
// Подключаем файл для подключения к базе данных
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные из формы
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $password_confirm = $_POST['password_confirm'] ?? '';

    // Проверяем, что все поля заполнены
    if (!empty($username) && !empty($email) && !empty($password) && !empty($password_confirm)) {
        // Проверяем, совпадают ли пароли
        if ($password !== $password_confirm) {
            $error = 'Пароли не совпадают.';
        } else {
            // Хэшируем пароль
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Подготовка SQL-запроса
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            if ($stmt->execute([$username, $email, $hashedPassword])) {
                $success = "Регистрация прошла успешно! Теперь вы можете <a href='login.php'>войти</a>.";
            } else {
                $error = 'Ошибка регистрации. Попробуйте ещё раз.';
            }
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
    <title>Регистрация</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="auth-container">
        <h1>Регистрация</h1>
        <form method="POST" action="register.php">
            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" name="username" id="username" placeholder="Введите имя" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Введите ваш email" required>
            </div>

            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password" placeholder="Введите пароль" required>
            </div>

            <div class="form-group">
                <label for="password_confirm">Подтвердите пароль</label>
                <input type="password" name="password_confirm" id="password_confirm" placeholder="Подтвердите пароль" required>
            </div>

            <button type="submit" class="submit-btn">Зарегистрироваться</button>

            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            <?php if (isset($success)) { echo "<p class='success'>$success</p>"; } ?>
        </form>
        <p>Уже есть аккаунт? <a href="login.php">Войти</a></p>
    </div>
</body>
</html>