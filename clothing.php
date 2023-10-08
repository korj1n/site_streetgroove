<?php require_once("blocks/header.php");?>
<head>
    <meta charset="UTF-8">
    <title>Каталог</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <div class = "divots"></div>
  <div class = "divots"></div>
  <div class="clothing" >
  <div style="display: flex; align-items: center; justify-content: center;">
    <h2 class="h2cath" style="margin-right: 10px;">Каталог</h2>
   <form action="clothing.php" method="GET">
      <input type="text" name="query" class="inputsechr" placeholder="Введите название товара" style="margin-right: 10px;">
      <button class="button" type="submit">Поиск</button>
    </form>
  </div>
</div>
<div style="display: flex; align-items: center; justify-content: center;">
 
</div>
<div class = "divots"></div>

<div class="clothing" >
<?php
$query = $_GET['query'];

// Формируем запрос для поиска товаров
$search_query = "SELECT name_product, price_product, id_product FROM product WHERE name_product LIKE '%$query%'";
$search_results = mysqli_query($link, $search_query);
// Выполнение запроса


// Обработка результатов
if (mysqli_num_rows($search_results) > 0) {
  while ($product = mysqli_fetch_array($search_results)) {
    ?>
    <a href="details.php?id=<?php echo $product['id_product']?>" class="product-link">
            <div  class="product">
                <img src="/media/img/product/<?php echo $product['id_product'];?>.jpg" width="250" height="250" alt="<?php echo $product['name_product']; ?>"><p>
                <span class="product-name"><?php echo $product['name_product']; ?></span>
                <span class="product-price"><?php echo $product['price_product']; ?> ₽</span>
                </p>
                <form id="productForm_<?php echo $product['id_product']; ?>" method="post" action="add_to_cart.php">
                <input type="hidden" name="id_product" value="<?php echo $product['id_product']; ?>">
                <button class="button add-to-cart-button" type="submit" name="add_to_cart">В корзину</button>
            </form>
            </div>
        </a>
    <?php 
  }
} else {
  echo "<p>Ничего не найдено.</p>";
}
?>
</div>
</div>
<div class = "divots"></div>


  
<div class = "map"> 
   <div class="maptext">
 <h2 class="h2map">Где находиться наш магазин?</h2>
<h4 class="mappod">Наш магазин находиться по адресу улица Шагова д.1</h4>
</div>
 <div class="obvodkamap"> 
 <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Aa14732c1ca8956874f4ec7b405254c5b5bd6671a5011b0664384823f5cddb2fd&amp;width=749&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
  </div> </div>
  <div class = "divots"></div>
  <div class="containerblock">
  <div class="block">
    <h2>Доставка по г. Кострома</h2>
    <h3 class="subtitle">Стандартная доставка от 5 дней -  от 500 руб.</h3>
    <img class="iconimg" src="/media/img/icon/free-icon-delivery-truck-2189145.svg" alt="Иконка" width="169" height="169">
  </div>
  <div class="block">
    <h2>Оплата при получении</h2>
    <h3 class="subtitle">Подробности уточняй у операторов по номеру <a> 8 (800) 700 82 60.</a></h3>
    <img class="iconimg" src="/media/img/icon/free-icon-shoes-3289150.svg" alt="Иконка" width="169" height="169">
  </div>
  <div class="block right">
    <h2>Подпишись на рассылку!</h2>
    <h3 class="subtitle">Будь в курсе всех раcпродаж, акций и новостей!</h3>
    <input type="email" placeholder="E-mail">
    <h3 class="subtitle">Подписываясь на рассылку, вы соглашаетесь с условиями оферты и политики конфиденциальности</h3>
    <a href="https://yandex.ru/maps/-/CDV~CC" target="_blank" class="button">Подписаться</a></div>
  </div>
</div>
<div class = "divots"></div>
<div class = "divots"></div>
      <?php require_once("blocks/footer.php");?>