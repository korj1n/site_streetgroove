<?php
require_once("MySiteDB.php");

if (isset($_GET['id'])) {
  $product_id = $_GET['id'];
} else {
  header("Location: index.php");
  exit();
}

$query = "SELECT * FROM product WHERE id_product = $product_id";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) == 0) {
  header("Location: index.php");
  exit();
}

$product = mysqli_fetch_assoc($result);

// Check if the user is logged in
session_start();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title><?php echo $product['name_product']; ?></title>
<link rel="stylesheet" href="style.css">
</head>

<body>
<?php require_once("blocks/header.php"); ?>
<div class="divots"></div>
<div class="divots"></div>
<img src="/media/img/product/<?php echo $product['id_product']; ?>.jpg" width="350" height="350" alt="<?php echo $product['name_product']; ?>">
<h3><?php echo $product['price_product']; ?></h3>
<p><?php echo $product['name_product']; ?></p>

<form id="productForm_<?php echo $product_row['id_product']; ?>" method="post" action="add_to_cart.php">
  <input type="hidden" name="id_product" value="<?php echo $product_row['id_product']; ?>">
  <button class="button" type="submit" name="add_to_cart">Добавить в корзину</button>
</form>
<a href="cabinet.php">Перейти в корзину</a>
<div class="divots"></div>
<div class="containerblock">
  <!-- Remaining content -->
</div>
</body>
<?php require_once("blocks/footer.php"); ?>
</html>
