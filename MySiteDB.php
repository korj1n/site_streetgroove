<?php
// Установка соединения с базой данных
$host = "127.0.0.1:3306";
$username = "root";
$password = "";
$dbname = "krs-Korizhin";

$link = mysqli_connect($host, $username, $password, $dbname);
if (!$link) {
    die("Ошибка соединения с базой данных: " . mysqli_connect_error());
}
/* $localhost = "127.0.0.1";
 $db = "store-krs-streetgroove";
 $user = "root";
 $password = "";
$link = mysqli_connect($localhost, $user, $password, $db) or die(mysqli_connect_error()); 
mysqli_set_charset($link, "utf8") or die(mysqli_error($link));
 $host = '127.0.0.1:3306';
$dbname = 'mydbs2';
$user = 'root';
$password = ' ';
*/


?>



