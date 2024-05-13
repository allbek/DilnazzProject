<!DOCTYPE html>
<html lang="ru">
<head>
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
                $fullname = $_POST['userfullname'];
                $ID = isset($_POST['userID']) ? $_POST['userID'] : null;
                
                // Проверка, соответствует ли пароль минимальной длине
                if (strlen($password) < 8) {
                    echo "<p style='color: red;'>Пароль должен содержать не менее 8 символов.</p>";
                } else {
                    // Проверка, предоставлен ли ID пользователя
                    if ($ID) {
                        // Обновление информации о пользователе в базе данных
                        $stmt = mysqli_prepare($conn, "UPDATE users SET userfullname=?, 
                        useremail=?, userpassword=? WHERE userID=?");
                        mysqli_stmt_bind_param($stmt, 'sss', $fullname, $password, $ID);
                        mysqli_stmt_execute($stmt);
                    }

                    header('Location:account_for_admin.php');
                    exit;
                }
            }

            $userlogin = $_SESSION['userlogin'];
            
            echo "<table cellpadding='0' cellspacing='0' border='1' id='tbl'>";
            echo "<tr>";
            echo "<td>Логин</td>";
            echo "<td>Полное имя</td>";
            echo "<td>Пароль</td>";
            echo "<td>Обновить</td>";
            echo "</tr>";

            $take = mysqli_query($conn,"SELECT * FROM users WHERE userlogin = '$userlogin';");

            // Отображение формы с текущими данными пользователя
            while ($data=mysqli_fetch_array($take)) {
                echo "<tr>";
                echo "<form method='POST' action=''>";
                echo "<td>".$data['userlogin']."</td>";
                echo "<td><input type='text' name='userfullname' value='".$data['userfullname']."'></td>";
                echo "<td><input type='text' name='userpassword' value='".$data['userpassword']."'></td>";
                echo "<input type='hidden' name='userID' value='" . $data['userID'] . "'>";
                echo "<td><button type='submit' class='btn' name='update'>Обновить</button></td>";
                echo "</form>";
                echo "</tr>";
            }

            echo "</table>";
        ?>
        
    </div>
</body>

</html>
