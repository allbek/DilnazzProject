<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Поиск расписания</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php require('partials/globals.php'); ?>
<?php require('partials/header.php'); ?>
<div class="content">
    <form action="" method="POST">
        <input type="text" name="searchInput" placeholder="Введите имя или фамилию" value="<?php echo isset($_POST['searchInput']) ? $_POST['searchInput'] : ''; ?>">
        <button type="submit">Поиск</button>
    </form>

    <form action="searchSchedule.php" method="GET">
    <?php
    if (isset($_POST['searchInput']) && !empty($_POST['searchInput'])) {
        $searchInput = $_POST['searchInput'];

        $sql = "SELECT userID, userfullname FROM users WHERE userfullname LIKE ? AND userstatus != 'admin'";
        $stmt = $conn->prepare($sql);
        $searchParam = "%" . $searchInput . "%";
        $stmt->bind_param("s", $searchParam);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<select name='userID'>";
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['userID'] . "'>" . htmlspecialchars($row['userfullname']) . "</option>";
            }
            echo "</select>";
        } else {
            echo "Нет совпадений.";
        }
        $stmt->close();
    }
    ?>
        <button type="submit">Загрузите расписание</button>
    </form>
    <?php if (isset($conn)) { $conn->close(); } ?>
</div>
</body>
</html>