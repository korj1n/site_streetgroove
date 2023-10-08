<div class="divots"></div>

<?php
require_once("blocks/header.php");
?>

<div class="divots"></div>


<div class="divots"></div><?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получите данные из формы
    $name_user = $_POST['name_user'];
    $family_user = $_POST['family_user'];
    $email_user = $_POST['email_user'];
    $number_user = $_POST['number_user'];
    $password_user = $_POST['password_user'];

    if (!empty($name_user) && !empty($family_user) && !empty($email_user) && !empty($number_user) && !empty($password_user)) {
        // Экранируйте пароль
        $esc_password = addslashes($password_user);

        // Сформируйте запрос на вставку данных в таблицу `user`
        $query = "INSERT INTO user (id_user, name_user, family_user, email_user, number_user, password_user) VALUES (NULL, '$name_user', '$family_user', '$email_user', '$number_user', '$esc_password')";

        // Выполните запрос на вставку данных в таблицу `user`
        $result = mysqli_query($link, $query);

        if ($result) {
            // Получите идентификатор вставленной строки пользователя
            $user_id = mysqli_insert_id($link);

            // Создайте новую корзину и получите ее идентификатор
            // Создайте новую корзину
            $bucket_query = "INSERT INTO bucket (count_bucket) VALUES (0)";
            $bucket_result = mysqli_query($link, $bucket_query);
            $bucket_id = mysqli_insert_id($link);

            if ($bucket_result) {
                // Обновите поле `bucket_id_bucket` в таблице `user` с идентификатором корзины
                $update_user_query = "UPDATE user SET bucket_id_bucket = $bucket_id WHERE id_user = $user_id";
                $update_user_result = mysqli_query($link, $update_user_query);
                if ($update_user_result) {
                    // Регистрация успешна
                    echo "Регистрация прошла успешно!";
                } else {
                    // Ошибка обновления данных пользователя
                    echo "Ошибка обновления данных пользователя. Пожалуйста, попробуйте снова.". mysqli_error($link);
                }
            } else {
                // Ошибка создания корзины
                echo "Ошибка создания корзины: " . mysqli_error($link);
            }
        } else {
            // Регистрация не удалась
            echo "Ошибка регистрации. Пожалуйста, попробуйте снова.". mysqli_error($link);
        }
    }
}
?>
<div class="divots"></div>




<div class="but12">
<form  method="post">   
        <h1>Регистрация</h1>

<p>Имя</p>
<input class="inputlog" name="name_user" type="text" required /><br />
<p>Фамилия</p>
<input class="inputlog" name="family_user" type="text" required /><br />
<p>Телефон</p>
<input class="inputlog" name="number_user" type="number" required /><br />
<p>Почта</p>
<input class="inputlog" name="email_user" type="email" required /><br />
<p>Пароль</p>
<input class="inputlog" name="password_user" type="password" required /><br />
<p><input class = "button" type="submit" value="Отправить" /></p>
</form>



        
        
       
    </div>

    <div class = "divots"></div>

</div>
</body>
<?php require_once("blocks/footer.php");?>
</html>