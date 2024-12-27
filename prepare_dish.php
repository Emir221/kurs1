<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dish_id = $_POST['dish_id'];

    // Получаем ингредиенты для выбранного блюда
    $query = "
        SELECT p.name AS product_name, di.quantity AS ingredient_quantity
        FROM dish_ingredients di
        JOIN products p ON di.product_id = p.id
        WHERE di.dish_id = :dish_id
    ";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':dish_id', $dish_id, PDO::PARAM_INT);
    $stmt->execute();
    $ingredients = $stmt->fetchAll();

    // Проверяем наличие продуктов на складе
    foreach ($ingredients as $ingredient) {
        $product_name = $ingredient['product_name'];
        $ingredient_quantity = $ingredient['ingredient_quantity'];

        // Получаем текущее количество продукта на складе
        $query = "SELECT quantity FROM products WHERE name = :product_name";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':product_name', $product_name, PDO::PARAM_STR);
        $stmt->execute();
        $product = $stmt->fetch();

        if ($product['quantity'] < $ingredient_quantity) {
            echo "Недостаточно $product_name для приготовления блюда!<br>";
            exit;
        }
    }

    // Если все продукты есть на складе, уменьшаем их количество
    foreach ($ingredients as $ingredient) {
        $product_name = $ingredient['product_name'];
        $ingredient_quantity = $ingredient['ingredient_quantity'];

        // Обновляем количество продукта
        $query = "
            UPDATE products
            SET quantity = quantity - :ingredient_quantity
            WHERE name = :product_name
        ";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':ingredient_quantity', $ingredient_quantity, PDO::PARAM_INT);
        $stmt->bindParam(':product_name', $product_name, PDO::PARAM_STR);
        $stmt->execute();
    }

    echo "Блюдо успешно приготовлено!";
}
?>