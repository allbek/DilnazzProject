<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Расписание</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require('partials/globals.php'); ?>
    <?php require('partials/header.php'); ?>
    <div class="content">
        <?php
        $days = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт'];
        $times = ['8:30 - 9:10', '9:25 - 10:05', '10:20 - 11:00', '11:05 - 11:45', '12:05 - 12:45', '13:05 - 13:45', '13:50 - 14:30', '14:45 - 15:25', '15:40 - 16:20', '16:25 - 17:05'];
        $user_id = $_SESSION['userID'];
        $status_query = "SELECT userstatus FROM users WHERE userID = $user_id";
        $status_result = $conn->query($status_query);
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
                    if ($user_status == 'student') {
                        $class_query = "SELECT class_id, subgroup FROM students WHERE userID = $user_id";
                        $class_result = $conn->query($class_query);
                        $class_info = $class_result->fetch_assoc();
                        $sql = "SELECT subject_id FROM schedule WHERE class_id = ? AND subgroup = ? AND day = ? AND time_slot = ?";
                    } elseif ($user_status == 'teacher') {
                        $sql = "SELECT class_id, subgroup FROM teacher_schedule WHERE userID = ? AND day = ? AND time_slot = ?";
                    }
                    $stmt = $conn->prepare($sql);
                    if ($user_status == 'student') {
                        $stmt->bind_param("iiss", $class_info['class_id'], $class_info['subgroup'], $day, $time);
                    } elseif ($user_status == 'teacher') {
                        $stmt->bind_param("iss", $user_id, $day, $time);
                    }
                    $stmt->execute();
                    $result = $stmt->get_result();
                    while ($row = $result->fetch_assoc()) {
                        if ($user_status == 'student') {
                            $subject_query = "SELECT subject_name FROM subjects WHERE subject_id = " . $row['subject_id'];
                            $subject_result = $conn->query($subject_query);
                            $subject_name = $subject_result->fetch_assoc()['subject_name'];
                            echo htmlspecialchars($subject_name);
                        } elseif ($user_status == 'teacher') {
                            $class_query = "SELECT class_name FROM classes WHERE class_id = " . $row['class_id'];
                            $class_result = $conn->query($class_query);
                            $class_name = $class_result->fetch_assoc()['class_name'];
                            echo htmlspecialchars($class_name) . " (" . htmlspecialchars($row['subgroup']) . ")";
                        }
                    }
                    ?>
                </td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>