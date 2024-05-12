<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить ученика</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require('partials/globals.php') ?>

    <?php require('partials/header.php') ?>

    <div class="content">
        <h2>Добавить ученика</h2>
        <form action="" method="POST">
            <label for="login">Логин:</label>
            <input type="text" id="login" name="login" required><br>

            <label for="fullname">ФИО:</label>
            <input type="text" id="fullname" name="fullname" required><br>

            <label for="password">Пароль:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="class">Класс:</label>
            <select id="class" name="class" required>
                <?php
                    $result = mysqli_query($conn, "SELECT * FROM classes");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='".$row['class_id']."'>".$row['class_name']."</option>";
                    }
                ?>
            </select><br>

            <label for="subgroup">Подгруппа:</label>
            <select id="subgroup" name="subgroup" required>
                <option value="1">1</option>
                <option value="2">2</option>
            </select><br>

            <button type="submit" class="btn" name="submit">Добавить ученика</button>
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
        $class_id = $_POST['class'];
        $subgroup = $_POST['subgroup'];
        
        $sql_user = "INSERT INTO users (userlogin, userfullname, userstatus, userpassword) VALUES (?, ?, 'student', ?)";
        $stmt_user = mysqli_prepare($conn, $sql_user);
        mysqli_stmt_bind_param($stmt_user, 'sss', $login, $fullname, $password);
        
        if (mysqli_stmt_execute($stmt_user)) {     
            $user_id = mysqli_insert_id($conn);
                   
            $sql_student = "INSERT INTO students (userID, class_id, subgroup) VALUES (?, ?, ?)";
            $stmt_student = mysqli_prepare($conn, $sql_student);
            mysqli_stmt_bind_param($stmt_student, 'iis', $user_id, $class_id, $subgroup);
            
            if (mysqli_stmt_execute($stmt_student)) {
                echo "<script>alert('Ученик успешно добавлен');</script>";
            } else {
                echo "<script>alert('Ошибка при добавлении ученика');</script>";
            }
            
            mysqli_stmt_close($stmt_student);
        } else {
            echo "<script>alert('Ошибка при добавлении ученика');</script>";
        }
        
        mysqli_stmt_close($stmt_user);
        mysqli_close($conn);
    }
?>
