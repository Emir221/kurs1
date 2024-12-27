<?php
$host = 'localhost'; // Обычно localhost
$dbname = 'dostavka_salat'; // Название базы данных
$username = 'root'; // Имя пользователя базы данных (по умолчанию root)
$password = 'root'; // Пароль (по умолчанию пустой)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    die();
}
?>