<?php
session_start();
session_destroy();  // Уничтожаем все данные сессии
header("Location: index.php");  // Перенаправление на главную страницу
exit;
?>
