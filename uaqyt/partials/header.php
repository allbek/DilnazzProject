<?php
    if (!empty($_SESSION['userlogin'])) {
        $userlogin = $_SESSION['userlogin'];
        $take = mysqli_query($conn,"SELECT * FROM `users` WHERE `userlogin` = '$userlogin';");
        $data = mysqli_fetch_array($take);
        $info = $data['userstatus'];
        $id = $data['userID'];
        if ($info == 'admin') {
            echo '<nav class="navbar">';
            echo '<li>';
            echo '<a class="nav-link" href="account_for_admin.php">Аккаунт</a>';
            echo '</li>';

            echo '<li>';
            echo '<a class="nav-link" href="catalog_for_admin.php">Расписание</a>';
            echo '</li>';

            echo '<li>';
            echo '<a class="nav-link" href="aboutus.php">О нас</a>';
            echo '</li>';

            echo '<li>';
            echo '<a class="nav-link" href="users.php">Пользователи</a>';
            echo '</li>';

            echo '<li>';
            echo '<a class="nav-link" href="exit.php">Выход</a>';
            echo '</li>';
            echo '</nav>';
          }
            else {
            echo '<nav class="navbar">';
            echo '<li>';
            echo '<a class="nav-link" href="account.php">Аккаунт</a>';
            echo '</li>';

            echo '<li>';
            echo '<a class="nav-link" href="catalog.php">Моё расписание</a>';
            echo '</li>';

            echo '<li>';
            echo '<a class="nav-link" href="full_catalog.php">Общее расписание</a>';
            echo '</li>';

            echo '<li>';
            echo '<a class="nav-link" href="orders.php">Сообщения</a>';
            echo '</li>';

            echo '<li>';
            echo '<a class="nav-link" href="aboutus.php">О нас</a>';
            echo '</li>';

            echo '<li>';
            echo '<a class="nav-link" href="exit.php">Выход</a>';
            echo '</li>';
            echo '</nav>';
        }
    } else {
        echo '<nav class="navbar">';
        echo '<li>';
        echo '<a class="nav-link" href="aboutus.php">О нас</a>';
        echo '</li>';

        echo '<li>';
        echo '<a class="nav-link" href="signinform.php">Войти</a>';
        echo '</li>';
        echo '</nav>';
    }
?>
