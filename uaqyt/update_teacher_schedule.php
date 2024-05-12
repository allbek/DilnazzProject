<?php
require 'partials/globals.php';

$teacher_id = $_POST['teacher_id'];
$classes = $_POST['classes'];

$conn->begin_transaction();

try {
    foreach ($classes as $day => $times) {
        foreach ($times as $time => $class_data) {
            $class_id = $class_data['class_id'];
            $subgroup = $class_data['subgroup'];

            if (!empty($class_id) && !empty($subgroup)) {
                // Вставляем данные или обновляем, если такая запись уже существует
                $sql = "INSERT INTO teacher_schedule (userID, day, time_slot, class_id, subgroup) VALUES (?, ?, ?, ?, ?) 
                        ON DUPLICATE KEY UPDATE 
                        class_id = VALUES(class_id), subgroup = VALUES(subgroup)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("issii", $teacher_id, $day, $time, $class_id, $subgroup);
                $stmt->execute();
                $stmt->close();
            } else {
                // Если класс или подгруппа не выбраны, удаляем такую запись из базы данных
                $sql = "DELETE FROM teacher_schedule WHERE userID = ? AND day = ? AND time_slot = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("iss", $teacher_id, $day, $time);
                $stmt->execute();
                $stmt->close();
            }
        }
    }
    $conn->commit();
    echo "Расписание успешно обновлено!";
    header("refresh:1; url=catalog_for_admin.php");
} catch (Exception $e) {
    $conn->rollback();
    echo "Ошибка: " . $e->getMessage();
}
$conn->close();
?>