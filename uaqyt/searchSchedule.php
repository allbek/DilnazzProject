<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Расписание</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <?php require('partials/globals.php'); ?>
    <?php require('partials/header.php'); ?>
    <?php
    // Получение userID из GET запроса
    $searched_user_id = $_GET['userID'];  

    // Получение полного имени пользователя
    $user_query = "SELECT userfullname FROM users WHERE userID = ?";
    $stmt = $conn->prepare($user_query);
    $stmt->bind_param("i", $searched_user_id);
    $stmt->execute();
    $user_result = $stmt->get_result();
    $user = $user_result->fetch_assoc();
    $user_fullname = $user['userfullname'] ?? 'Неизвестный пользователь';

    echo "<h2>Расписание для: " . htmlspecialchars($user_fullname) . "</h2>";

    $days = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт'];
    $times = ['8:30 - 9:10', '9:25 - 10:05', '10:20 - 11:00', '11:05 - 11:45', '12:05 - 12:45', '13:05 - 13:45', '13:50 - 14:30', '14:45 - 15:25', '15:40 - 16:20', '16:25 - 17:05'];
    $status_query = "SELECT userstatus FROM users WHERE userID = ?";
    $status_stmt = $conn->prepare($status_query);
    $status_stmt->bind_param("i", $searched_user_id);
    $status_stmt->execute();
    $status_result = $status_stmt->get_result();
    $user_status = $status_result->fetch_assoc()['userstatus'];
    ?>
    <table>
        <tr>
            <th>День / Время</th>
            <?php foreach ($times as $time): ?>
            <th><?php echo $time; ?></th>
            <?php endforeach; ?>
        </tr>
        <?php foreach ($days as $day): ?>
        <tr>
            <td><?php echo $day; ?></td>
            <?php foreach ($times as $time): ?>
            <td>
                <?php
                $empty = true;  // Флаг для определения пустых ячеек
                if ($user_status == 'student') {
                    $sql = "SELECT subject FROM student_schedule WHERE userID = ? AND day = ? AND time_slot = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("iss", $searched_user_id, $day, $time);
                } elseif ($user_status == 'teacher') {
                    $sql = "SELECT class_id, subgroup FROM teacher_schedule WHERE userID = ? AND day = ? AND time_slot = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("iss", $searched_user_id, $day, $time);
                }
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    $empty = false;  // Слот не пустой, данные есть
                    if ($user_status == 'student') {
                        $subject_query = "SELECT subject_name FROM subjects WHERE subject_id = ?";
                        $subject_stmt = $conn->prepare($subject_query);
                        $subject_stmt->bind_param("i", $row['subject']);
                        $subject_stmt-> execute();
                        $subject_result = $subject_stmt->get_result();
                        $subject_name = $subject_result->fetch_assoc()['subject_name'];
                        echo htmlspecialchars($subject_name);
                    } elseif ($user_status == 'teacher') {
                        $class_query = "SELECT class_name FROM classes WHERE class_id = ?";
                        $class_stmt = $conn->prepare($class_query);
                        $class_stmt->bind_param("i", $row['class_id']);
                        $class_stmt->execute();
                        $class_result = $class_stmt->get_result();
                        $class_name = $class_result->fetch_assoc()['class_name'];
                        echo htmlspecialchars($class_name) . " (" . htmlspecialchars($row['subgroup']) . ")";
                    }
                }
                if ($empty) {
                    // Показать кнопку, если ячейка пуста
                    echo "<button onclick=\"location.href='booking_form.php?day=$day&time=$time'\">Записаться на консультацию</button>";
                }
                ?>
            </td>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>