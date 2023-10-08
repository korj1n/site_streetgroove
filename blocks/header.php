<?php
// Начало новой страницы
session_start();
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="CSS/style.css">
<?php require_once("MySiteDB.php");?>
  <body>
    <header>
      <div class="container1">
        <a href="index.php" class="logo1">
          <img src="/media/img/icon/Street Groove.svg" alt="Logo">
        </a>
        <nav>
          <ul>
            <li><a href="index.php"<?php if(basename($_SERVER['PHP_SELF']) == 'index.php') echo 'class="active"'; ?>>Главная</a></li>
            <li><a href="clothing.php"<?php if(basename($_SERVER['PHP_SELF']) == 'clothing.php') echo 'class="active"'; ?>>Одежда</a></li>
            <li><a href="news.php"<?php if(basename($_SERVER['PHP_SELF']) == 'news.php') echo 'class="active"'; ?>>Новости</a></li>
            <li><a href="about.php"<?php if(basename($_SERVER['PHP_SELF']) == 'about.php') echo 'class="active"'; ?>>О компании</a></li>
          </ul>
        </nav>
        <div class="right-side">
      <?php if(isset($_SESSION['email'])) { ?>
        <a href="cabinet.php" class="login-btn"><?php echo $_SESSION['email'] ?></a>
      <?php } else { ?>
        <a href="login.php" class="login-btn">Войти</a>
      <?php } ?>
    </div>
        </div>
      </div>
    </header>
  </body>
</html>