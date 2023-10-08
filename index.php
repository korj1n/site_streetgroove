<?php require_once("blocks/header.php");?>
<head>
    <meta charset="UTF-8">
    <title>Главная</title>
   
  </head>
<div class="video-container">
    <video autoplay loop muted>
      <source src="/media/video/video.mp4" type="video/mp4">
    </video>
    <div class="overlay">
      <h1 class="logo">STREET GROOVE</h1>
      <div class="deviz">      
      <p class="fish">Твой стиль </p>
      <p class="fish1"> - </p>
      <p class="fish2">устрой дестрой.</p></div>
      <a class="button" href="clothing.php">Перейти в католог</a>
      
    </div>
  </div>
  <div class="second-block">
  <h2 class="h2clothing">Одежда</h2>
  <div class="odeahda">
  <a href="clothing.php" >     
  <div class="image-container">
          <img src="/media/img/blocks/men.png" alt="Man">
          <div class="text-overlay left">Мужчины</div>
        </div></a> 
        <a  href="clothing.php" > 
        <div class="image-container">
          <img src="/media/img/blocks/women.png" alt="Women">
          <div class="text-overlay right">Женщины</div>
        </div></a>
      </div>
  </div>
  </body>
  <div class = "divots"></div>
  <div class="novinka"> 
  
  

  <h2 class="h2nov">Новинки</h2>
  <div class="obvodka"> 
  <?php
    require_once("blocks/header.php");

    $query = "SELECT name_product, price_product, id_product FROM product LIMIT 4";
    $select_product = mysqli_query($link, $query);

    while ($product = mysqli_fetch_array($select_product)) {
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
    ?>
  </div>
  </div>
  <div class = "divots"></div>
 
  <h2 class="h2logo">С кем мы сотрудничаем</h2>
  <div class="sotr">
  <marquee direction="left">
    <img class="sotricon" src="/media/img/blocks/1.svg" />
    <img class="sotricon" src="/media/img/blocks/2.svg" />
    <img class="sotricon" src="/media/img/blocks/3.svg" />
    <img class="sotricon" src="/media/img/blocks/4.svg" />
    <img class="sotricon" src="/media/img/blocks/5.svg" />
    <img class="sotricon" src="/media/img/blocks/6.svg" />
  </marquee>
  </div>
  <div class = "divots"></div>
  <div class = "divots"></div>
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
 
  <?php require_once("blocks/footer.php");?>
</html>
