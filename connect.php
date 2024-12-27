<?php
$host = 'localhost';  // Хост базы данных (например, localhost)
$dbname = 'dostavka_salat';  // Название вашей базы данных
$username = 'root';  // Имя пользователя (по умолчанию для XAMPP - root)
$password = 'root';  // Пароль (по умолчанию для XAMPP - пустой)

try {
    // Устанавливаем соединение с базой данных через PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Устанавливаем атрибуты для обработки ошибок
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("SET NAMES utf8");  // Устанавливаем кодировку
} catch (PDOException $e) {
    // Если ошибка подключения, выводим сообщение и прекращаем выполнение
    die("Не удалось подключиться к базе данных: " . $e->getMessage());
}
?>
