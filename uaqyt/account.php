<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление учетной записью</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require('partials/globals.php') ?>
    <?php require('partials/header.php') ?>

    <!-- Секция управления учетной записью -->
    <div class="content">
        <h1>Управление учетной записью</h1>
        <!-- Отображение информации о пользователе -->
        <?php
            if (isset($_POST['update'])) {
                // Получение данных из формы
                $password = $_POST['userpassword'];
                $ID = isset($_POST['userID']) ? $_POST['userID'] : null;
                
                // Проверка, соответствует ли пароль минимальной длине
                if (strlen($password) < 8) {
                    echo "<p style='color: red;'>Пароль должен содержать не менее 8 символов.</p>";
                } else {
                    // Проверка, предоставлен ли ID пользователя
                    if ($ID) {
                        // Обновление информации о пользователе в базе данных
                        $stmt = mysqli_prepare($conn, "UPDATE users SET userpassword=? WHERE userID=?");
                        mysqli_stmt_bind_param($stmt, 'ss', $password, $ID);
                        mysqli_stmt_execute($stmt);
                    }

                    header('Location:account.php');
                    exit;
                }
            }

            $userlogin = $_SESSION['userlogin'];
            $result = mysqli_query($conn, "SELECT * FROM users WHERE userlogin = '$userlogin'");
            if(mysqli_num_rows($result) > 0) {
                echo "<table border='1'>";
                echo "<tr><th>Логин</th><th>Полное имя</th><th>Пароль</th></tr>";
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['userlogin'] . "</td>";
                    echo "<td>" . $row['userfullname'] . "</td>";
                    echo "<td>";
                    echo "<form method='POST' action=''>";
                    echo "<input type='text' name='userpassword' value='" . $row['userpassword'] . "'>";
                    echo "<input type='hidden' name='userID' value='" . $row['userID'] . "'>";
                    echo "<button type='submit' class='btn' name='update'>Обновить</button>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Пользователь не найден.</p>";
            }
        ?>
    </div>
</body>
</html>
