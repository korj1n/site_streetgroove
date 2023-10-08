<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Вход в личный кабинет</title>
    
</head>
<?php require_once("blocks/header.php");?>
<body>
<div class = "divots"></div>
  <div class = "divots"></div>
    <div class="but12">
    
        <h1>Вход в личный кабинет</h1>
        <form action="" method="post">
            <label for="email" >Email:</label><br>
            <input type="email" class="inputlog" id="email" name="email"><br>
            <label for="password">Пароль:</label><br>
            <input class="inputlog" type="password" id="password" name="password"><br><br>
            <input type="submit" class= "button" value="Войти">
            <a class="button" href="register.php">Регистрация</a>
        </form>
       
    </div>
</body>
<div class = "divots"></div>
  <div class = "divots"></div>
</html>
  <?php require_once("blocks/footer.php");?>
<?php
require_once("MySiteDB.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
$email = $_POST['email'];
$password = $_POST['password'];

// Проверка соответствия email и пароля в базе данных
$query = "SELECT * FROM user WHERE email_user='$email' AND password_user='$password'";
$result = mysqli_query($link, $query);

if (mysqli_num_rows($result) == 1) {
    // Fetch the user_id from the result
    $row = mysqli_fetch_assoc($result);
    $id_user = $row['id_user'];

    // Set up the session
    session_start();
    $_SESSION['email'] = $email;
    $_SESSION['id_user'] = $id_user;
    header("location: cabinet.php");
} else {
    // Неверный email или пароль
    $error = "Неверный email или пароль";
}
}
?>

