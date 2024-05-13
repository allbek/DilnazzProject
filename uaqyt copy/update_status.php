<?php
require('partials/globals.php'); // Подключение к базе данных и глобальные настройки

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['meetID'], $_POST['status'])) {
    $meetID = $_POST['meetID'];
    $new_status = $_POST['status'];
    $current_user_id = $_SESSION['userID']; // ID текущего пользователя из сессии

    // Проверка, что текущий пользователь является создателем запроса на встречу
    $check_sql = "SELECT userID FROM meeting_requests WHERE meetID = ?";
    $check_stmt = $conn->prepare($check_sql);
    $check_stmt->bind_param("i", $meetID);
    $check_stmt->execute();
    $check_stmt->bind_result($userID);
    $check_stmt->fetch();
    $check_stmt->close();

    if ($userID == $current_user_id) {
        // Обновление статуса запроса на встречу
        $sql = "UPDATE meeting_requests SET status = ? WHERE meetID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $new_status, $meetID);

        if ($stmt->execute()) {
            // При успешном обновлении статуса
            echo "Статус успешно обновлен!";
        } else {
            // В случае ошибки при обновлении
            echo "Ошибка при обновлении статуса: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Вы не имеете права изменять статус этого запроса.";
    }
} else {
    echo "Неверный запрос.";
}

$conn->close();

// Перенаправление обратно на страницу заказов
header("Location: orders.php");
exit();
?>