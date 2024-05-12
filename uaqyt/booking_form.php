<!DOCTYPE html>
<html lang="ru">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Отправка запроса о встече</title>
    <link rel="stylesheet" href="style.css">
<body>
    <?php require('partials/globals.php'); ?>
    <?php require('partials/header.php'); ?>
    <form action="submit_request.php" method="post">
        <h2>Запись на консультацию</h2>
        <input type="hidden" name="userID" value="<?php echo htmlspecialchars($_GET['userID']); ?>">
        <input type="hidden" name="day" value="<?php echo htmlspecialchars($_GET['day']); ?>">
        <input type="hidden" name="time" value="<?php echo htmlspecialchars($_GET['time']); ?>">
        <input type="text" name="topic" placeholder="Тема урока" required>
        <textarea name="description" placeholder="Описание встречи" required></textarea>
        <button type="submit">Отправить запрос</button>
    </form>
</body>
</html>