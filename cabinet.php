<?php 

// Подключение к базе данных
// $link = mysqli_connect("192.168.0.200", "stis3-33", "E9y№7v)7RiVX", "krs_korizhin");
$link = mysqli_connect("127.0.0.1:3306", "root", "", "krs-Korizhin");

if (!$link) {
    die("Ошибка соединения: " . mysqli_connect_error());
}

// Запуск сессии
session_start();

if (isset($_POST['logout'])) {
  // Уничтожаем все данные сессии
  session_destroy();
  
  // Перенаправляем пользователя на страницу входа или другую нужную страницу
  header('Location: login.php');
  exit;
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Личный кабинет</title>
</head>
<body>
<?php require_once("blocks/header.php");?>
<div class="divots"></div>
<div class="divots"></div>
<?php 
$query = "SELECT * FROM user WHERE email_user='".mysqli_real_escape_string($link, $_SESSION['email'])."'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
?>
<div class="profile-container">
    <img class="profile-icon" src="media\img\icon\icon _user_.svg" alt="User Icon">
    <div class="profile-info">
      <span class="profile-name"><?php echo $row['name_user']; ?></span>
      <span class="profile-surname"><?php echo $row['family_user']; ?></span>
      <span class="profile-email"><?php echo $_SESSION['email']; ?></span>

  </form>
     
     
    
    </div>
</div>
<div class="divots"></div>
<div style="display: flex; align-items: center;">
  <form method="post" action="" style="margin-right: 30px;">
    <input class="button" type="submit" name="logout" value="Выход">
  </form>
  <form method="post" action="" style="margin-right: 30px;">
    <input class="button" type="submit" name="logout" value="Оплатить корзину">
  </form>
</div>
<div class="container">
  <h1>Корзина:</h1>
  <?php
    // Проверка, авторизован ли пользователь
    if (!isset($_SESSION['id_user'])) {
        echo "Для просмотра корзины необходимо авторизоваться.";
        exit;
    }

    // Получение идентификатора пользователя
    $id_user = $_SESSION['id_user'];

    // Запрос для получения идентификатора корзины пользователя
    $bucket_query = "SELECT bucket_id_bucket FROM user WHERE id_user = $id_user";
    $bucket_result = mysqli_query($link, $bucket_query);

    if ($bucket_result) {
        $bucket_row = mysqli_fetch_assoc($bucket_result);
        $bucket_id = $bucket_row['bucket_id_bucket'];

        // Запрос для получения товаров в корзине
        $products_query = "SELECT p.* FROM product p INNER JOIN product_has_bucket pb ON p.id_product = pb.product_id_product WHERE pb.bucket_id_bucket = $bucket_id";
        $products_result = mysqli_query($link, $products_query);

        if ($products_result && mysqli_num_rows($products_result) > 0) {
            // Отображение товаров в корзине

            // Запрос для получения значения count_bucket
            $count_bucket_query = "SELECT count_bucket, payment_state FROM bucket WHERE id_bucket = $bucket_id";
            $count_bucket_result = mysqli_query($link, $count_bucket_query);
            
            if ($count_bucket_result && mysqli_num_rows($count_bucket_result) > 0) {
                $count_bucket_row = mysqli_fetch_assoc($count_bucket_result);
                $count_bucket = $count_bucket_row['count_bucket'];
                $payment_state = $count_bucket_row['payment_state'];
            } else {
                $count_bucket = 0;
                $payment_state = 'Не оплачено'; // Set a default value if payment_state is not found
            }
            

            ?>  
            <h2 class="h2cath">Цена корзины: <?php echo $count_bucket; ?> ₽</h2>
            <h2 class="h2cath">Статус оплаты: <?php echo $payment_state; ?></h2>
            <?php

            while ($product_row = mysqli_fetch_assoc($products_result)) {
                ?>
                <a href="details.php?id=<?php echo $product_row['id_product']?>" class="product-link">
                    <div class="product">
                        <img src="/media/img/product/<?php echo $product_row['id_product'];?>.jpg" width="250" height="250" alt="<?php echo $product_row['name_product']; ?>">
                        <p>
                            <span class="product-name"><?php echo $product_row['name_product']; ?></span>
                            <span class="product-price"><?php echo $product_row['price_product']; ?> ₽</span>
                        </p>
                        
                        <form method="post" action="remove_from_cart.php" class="remove-form">
                            <input type="hidden" name="id_product" value="<?php echo $product_row['id_product']; ?>">
                            <button class="button" type="submit" name="remove_from_cart">Удалить из корзины</button>
                        </form>
                    </div>
                </a>
                
                <?php
            }
        } else {
            ?>
         
            <div class="container2">
                <div class="vertcial" >
                    <div class="left1">
                        <p>Корзина пустая!</p>
                    </div>
                    <div class="leftmal">
                        <p>Добавьте товар!</p>
                    </div>
                    <div class="but1">
                       <a href="clothing.php" class="button">Каталог</a>
                    </div>
                </div>
                <div class="imagecloth"></div>
            </div>
            <?php
        }
    } else {
        echo "Ошибка при получении корзины пользователя (обратитесь за помощью к программисту): " . mysqli_error($link);
    }
?>
</div>
<div class="divots"></div>
<script>
    // Обработчик отправки формы удаления товара
    const removeForms = document.querySelectorAll('.remove-form');
    removeForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            const confirmDelete = confirm("Вы действительно хотите удалить товар из корзины?");
            if (!confirmDelete) {
                return;
            }

            const formData = new FormData(form);
            fetch(form.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(result => {
                console.log(result);
                location.reload(); // Перезагрузка страницы после удаления товара
            })
            .catch(error => {
                console.error('Ошибка:', error);
            });
        });
    });
</script>
</body>
 
<?php require_once("blocks/footer.php");?>
</html>