<?php
session_start();
require_once("MySiteDB.php");

// Проверка, авторизован ли пользователь
if (!isset($_SESSION['id_user'])) {
    echo "Для удаления товара из корзины необходимо авторизоваться.";
    exit;
}

// Получение идентификатора пользователя
$id_user = $_SESSION['id_user'];

// Получение идентификатора товара из формы
$id_product = $_POST['id_product'];
// Проверка, существует ли такой товар
$product_query = "SELECT * FROM Product WHERE id_product = $id_product";
$product_result = mysqli_query($link, $product_query);
if (!$product_result || mysqli_num_rows($product_result) == 0) {
    echo "Такого товара не существует.";
    exit;
}


// Получение цены товара
$product_row = mysqli_fetch_assoc($product_result);
$price_product = $product_row['price_product'];

// Получение идентификатора корзины пользователя
$bucket_query = "SELECT bucket_id_bucket FROM User WHERE id_user = $id_user";
$bucket_result = mysqli_query($link, $bucket_query);
if (!$bucket_result || mysqli_num_rows($bucket_result) == 0) {
    echo "Ошибка при получении корзины пользователя.";
    exit;
}

$bucket_row = mysqli_fetch_assoc($bucket_result);
$bucket_id = $bucket_row['bucket_id_bucket'];

// Проверка, есть ли такой товар в корзине
$existing_product_query = "SELECT * FROM product_has_bucket WHERE product_id_product = $id_product AND bucket_id_bucket = $bucket_id";
$existing_product_result = mysqli_query($link, $existing_product_query);
if ($existing_product_result && mysqli_num_rows($existing_product_result) > 0) {
    // Удаление товара из корзины
    $delete_query = "DELETE FROM product_has_bucket WHERE product_id_product = $id_product AND bucket_id_bucket = $bucket_id";
    $delete_result = mysqli_query($link, $delete_query);

    if ($delete_result) {
        // Обновление поля count_bucket в таблице bucket
        $update_bucket_query = "UPDATE bucket SET count_bucket = count_bucket - $price_product WHERE id_bucket = $bucket_id";
        $update_bucket_result = mysqli_query($link, $update_bucket_query);

        if ($update_bucket_result) {
            echo "Товар успешно удален из корзины.";
        } else {
            echo "Ошибка при обновлении корзины.";
        }
    } else {
        echo "Ошибка при удалении товара из корзины.";
    }
} else {
    echo "Этого товара нет в корзине.";
}

// Закрытие соединения с базой данных
mysqli_close($link);
?>