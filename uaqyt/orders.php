<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="style.css">
<body>
    <?php require('partials/globals.php'); ?>
    <?php require('partials/header.php'); ?>
    <?php
        $current_user_id = $_SESSION['userID']; // ID текущего пользователя из сессии

        // Обновлённый SQL запрос для получения имен создателей и получателей
        $sql = "SELECT m.meetID, m.creatorID, m.userID, m.day, m.time_slot, m.topic, m.description, m.status, u1.userfullname AS creatorName, u2.userfullname AS userName 
                FROM meeting_requests m
                JOIN users u1 ON m.creatorID = u1.userID
                JOIN users u2 ON m.userID = u2.userID
                WHERE m.userID = ? OR m.creatorID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $current_user_id, $current_user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        echo "<h1>Ваши запросы на встречу</h1>";
        echo "<table border='1'>";
        echo "<tr><th>Отправитель</th><th>Получатель</th><th>День</th><th>Время</th><th>Тема</th><th>Описание</th><th>Статус</th><th>Действия</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['creatorName']) . "</td>";
            echo "<td>" . htmlspecialchars($row['userName']) . "</td>";
            echo "<td>" . $row['day'] . "</td>";
            echo "<td>" . $row['time_slot'] . "</td>";
            echo "<td>" . htmlspecialchars($row['topic']) . "</td>";
            echo "<td>" . htmlspecialchars($row['description']) . "</td>";
            echo "<td>" . $row['status'] . "</td>";
            echo "<td>";
            // Только пользователь, получивший запрос, может изменить статус
            if ($row['userID'] == $current_user_id) {
                echo "<form action='update_status.php' method='post'>";
                echo "<input type='hidden' name='meetID' value='" . $row['meetID'] . "'>";
                echo "<select name='status'>";
                echo "<option value='pending'" . ($row['status'] == 'pending' ? ' selected' : '') . ">В ожидании</option>";
                echo "<option value='confirmed'" . ($row['status'] == 'confirmed' ? ' selected' : '') . ">Подтверждено</option>";
                echo "<option value='rejected'" . ($row['status'] == 'rejected' ? ' selected' : '') . ">Отклонено</option>";
                echo "</select>";
                echo "<input type='submit' value='Обновить статус'>";
                echo "</form>";
            } else {
                echo "Только просмотр";
            }
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";

        // Закрытие подготовленного запроса и соединения
        $stmt->close();
        $conn->close();
        ?>
    <?php require('partials/footer.php'); ?>
</body>
</html>