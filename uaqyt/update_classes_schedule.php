<?php

require 'partials/globals.php';

$class_id = $_POST['class_id'];
$subgroup_id = $_POST['subgroup_id'];
$subjects = $_POST['subjects'];

$conn->begin_transaction();

try {
    foreach ($subjects as $day => $times) {
        foreach ($times as $time => $subject_id) {
            if (!empty($subject_id)) {
                // Validate subject_id exists
                $stmt = $conn->prepare("SELECT COUNT(*) FROM subjects WHERE subject_id = ?");
                $stmt->bind_param("i", $subject_id);
                $stmt->execute();
                $stmt->bind_result($count);
                $stmt->fetch();
                $stmt->close();

                if ($count == 0) {
                    throw new Exception("Invalid subject_id: $subject_id");
                }

                // Insert or update class/subgroup schedule
                $sql = "INSERT INTO schedule (day, time_slot, class_id, subgroup, subject_id) VALUES (?, ?, ?, ?, ?)
                        ON DUPLICATE KEY UPDATE subject_id = VALUES(subject_id)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssiii", $day, $time, $class_id, $subgroup_id, $subject_id);
                $stmt->execute();
                $stmt->close();

                // Fetch all students in the class/subgroup
                $sql = "SELECT userID FROM students WHERE class_id = ? AND subgroup = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ii", $class_id, $subgroup_id);
                $stmt->execute();
                $result = $stmt->get_result();
                
                // Update each student's schedule
                while ($student = $result->fetch_assoc()) {
                    $sql = "INSERT INTO student_schedule (userID, day, time_slot, subject) VALUES (?, ?, ?, ?)
                            ON DUPLICATE KEY UPDATE subject = VALUES(subject)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("isss", $student['userID'], $day, $time, $subject_id);
                    $stmt->execute();
                    $stmt->close();
                }
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