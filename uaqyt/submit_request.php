<?php
require('partials/globals.php'); // Подключение к базе данных и глобальные настройки

$user_id = $_POST['user_id']; // ID пользователя, который отправляет запрос
$day = $_POST['day']; // День, когда запланирована встреча
$time_slot = $_POST['time']; // Время встречи
$topic = $_POST['topic']; // Тема встречи
$description = $_POST['description']; // Описание встречи

// Подготовка запроса для вставки данных в таблицу meeting_requests
$sql = "INSERT INTO meeting_requests (userID, day, time_slot, topic, description, status) VALUES (?, ?, ?, ?, ?, 'pending')";
$stmt = $conn->prepare($sql);

// Проверка подготовки запроса
if ($stmt === false) {
    die('MySQL prepare error: ' . $conn->error);
}

// Привязка параметров к подготовленному запросу
$stmt->bind_param("issss", $user_id, $day, $time_slot, $topic, $description);

// Выполнение подготовленного запроса
if ($stmt->execute()) {
    echo "Ваш запрос на встречу успешно отправлен!";
    // Перенаправление на страницу подтверждения или информации
    header("Location: confirmation_page.php");
} else {
    echo "Ошибка при отправке запроса: " . $stmt->error;
}

// Закрытие подготовленного запроса и соединения
$stmt->close();
$conn->close();
?>