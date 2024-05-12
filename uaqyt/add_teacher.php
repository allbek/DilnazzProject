<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить учителя</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require('partials/globals.php') ?>

    <?php require('partials/header.php') ?>

    <div class="content">
        <h2>Добавить учителя</h2>
        <form action="" method="POST">
            <label for="login">Логин:</label>
            <input type="text" id="login" name="login" required><br>

            <label for="fullname">ФИО:</label>
            <input type="text" id="fullname" name="fullname" required><br>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required><br>

            <button type="submit" class="btn" name="submit">Добавить учителя</button>
        </form>
    </div>

    <?php require('partials/footer.php') ?>

</body>
</html>

<?php    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST['login'];
        $fullname = $_POST['fullname'];
        $password = $_POST['password'];
        
        // Вставка данных в таблицу users
        $sql_user = "INSERT INTO users (userlogin, userfullname, userstatus, userpassword) VALUES (?, ?, 'teacher', ?)";
        $stmt_user = mysqli_prepare($conn, $sql_user);
        mysqli_stmt_bind_param($stmt_user, 'sss', $login, $fullname, $password);
        
        if (mysqli_stmt_execute($stmt_user)) {
            // Получение идентификатора пользователя
            $user_id = mysqli_insert_id($conn);
            
            // Вставка данных в таблицу teachers для каждого выбранного предмета
            $sql_teacher = "INSERT INTO teachers (userID) VALUES (?)";
            $stmt_teacher = mysqli_prepare($conn, $sql_teacher);
        
            // Привязываем параметры
            mysqli_stmt_bind_param($stmt_teacher, 'i', $user_id);
            
            // Выполняем запрос
            if (!mysqli_stmt_execute($stmt_teacher)) {
                echo "<script>alert('Ошибка при добавлении учителя');</script>";
            }
            
            echo "<script>alert('Учитель успешно добавлен');</script>";
        } else {
            echo "<script>alert('Ошибка при добавлении учителя');</script>";
        }
        
        // Закрываем запросы и соединение
        mysqli_stmt_close($stmt_user);
        mysqli_stmt_close($stmt_teacher);
        mysqli_close($conn);
    }
?>
