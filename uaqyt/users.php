<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require('partials/globals.php') ?>

    <?php require('partials/header.php') ?>

    <div>
		<h2>Управление учетными записями</h2>

        <!-- Search form -->
        <form action="" method="GET">
            <input type="text" name="search_query" placeholder="Поиск по пользователям">
            <button type="submit" class="btn">Поиск</button>
        </form>

        <!-- Buttons for adding users -->
        <a href="add_teacher.php" class="btn">Добавить учителя</a>
        <a href="add_student.php" class="btn">Добавить ученика</a>

		<?php
            // Retrieving user login from session
            $userlogin = $_SESSION['userlogin'];
            
            // Displaying table headers
            echo "<table cellpadding='0' cellspacing='0' border='1' id='tbl'>";
            echo "<tr>";
            echo "<td>Login</td>";
            echo "<td>Fullname</td>";
            echo "<td>Delete</td>";
            echo "</tr>";

            // Retrieving search query if present
            $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

            // Querying users table excluding current user and applying search filter
            $query = "SELECT * FROM users WHERE userstatus != 'admin'";
            if (!empty($search_query)) {
                $query .= " AND (userlogin LIKE '%$search_query%' OR userfullname LIKE '%$search_query%')";
            }
            $take = mysqli_query($conn, $query);

            while ($data = mysqli_fetch_array($take)) {
                echo "<tr>";
                echo "<form method='POST' action=''>";
                // Displaying user data
                echo "<td>".$data['userlogin']."</td>";
                echo "<td>".$data['userfullname']."</td>";
                echo "<input type='hidden' name='userlogin' value='".$data['userlogin']."'>";
                // Button to delete user
                echo "<td><button type='submit' class='btn' name='dlt'>Удалить</button>";
                echo "</form>";
                echo "</tr>";
            }

            echo "</table>";

            // Updating user status
            if (isset($_POST['update'])) {
                $login = $_POST['userlogin'];
                $userstatus = $_POST['userstatus'];
            
                $stmt = mysqli_prepare($conn, "UPDATE users SET userstatus=? WHERE userlogin=?");
                mysqli_stmt_bind_param($stmt, 'ss', $userstatus, $login);
                mysqli_stmt_execute($stmt);
            
                header('Location: '.$_SERVER['PHP_SELF']);
                exit;
            }
            
            // Deleting user
            if (isset($_POST['dlt'])) {
                $login = $_POST['userlogin'];
                mysqli_query($conn, "DELETE FROM `users` WHERE `userlogin` = '$login';");
                header ('Location: users.php');
            }
		?>
	</div>

    <?php require('partials/footer.php') ?>

</body>

</html>
