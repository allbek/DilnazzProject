<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление расписанием учителей</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require('partials/globals.php'); ?>
    <?php require('partials/header.php'); ?>
    <?php
    $days = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт'];
    $times = ['8:30 - 9:10', '9:25 - 10:05', '10:20 - 11:00', '11:05 - 11:45', '12:05 - 12:45', '13:05 - 13:45', '13:50 - 14:30', '14:45 - 15:25', '15:40 - 16:20', '16:25 - 17:05'];

    if (isset($_POST['teacher_id'])) {
        $teacher_id = $_POST['teacher_id'];
    }
    ?>

    <form action="" method="post">
        <label for="teacher_selector">Выберите учителя:</label>
        <select id="teacher_selector" name="teacher_id" onchange="this.form.submit()">
            <option value="">--Выберите учителя--</option>
            <?php
            $query = "SELECT userID, userfullname FROM users WHERE userstatus = 'teacher'";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                $selected = (isset($teacher_id) && $teacher_id == $row['userID']) ? 'selected' : '';
                echo "<option value='{$row['userID']}' {$selected}>{$row['userfullname']}</option>";
            }
            ?>
        </select>
    </form>

    <?php if (isset($teacher_id)): ?>
    <form action="update_teacher_schedule.php" method="post">
        <input type="hidden" name="teacher_id" value="<?php echo $teacher_id; ?>">

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
                    $sql = "SELECT class_id, subgroup FROM teacher_schedule WHERE userID = ? AND day = ? AND time_slot = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("iss", $teacher_id, $day, $time);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $current_class = $result->fetch_assoc() ?: ['class_id' => '', 'subgroup' => ''];
                    ?>
                    <select name="classes[<?php echo $day; ?>][<?php echo $time; ?>][class_id]">
                        <option value="">Выберите класс</option>
                        <?php
                        $classes_query = "SELECT class_id, class_name FROM classes";
                        $classes_result = $conn->query($classes_query);
                        while ($class = $classes_result->fetch_assoc()) {
                            $selected = $current_class['class_id'] == $class['class_id'] ? 'selected' : '';
                            echo "<option value='{$class['class_id']}' $selected>{$class['class_name']}</option>";
                        }
                        ?>
                    </select><br>

                    <select name="classes[<?php echo $day; ?>][<?php echo $time; ?>][subgroup]">
                        <option value="">Выберите подгруппу</option>
                        <option value="1" <?php echo $current_class['subgroup'] == '1' ? 'selected' : ''; ?>>1</option>
                        <option value="2" <?php echo $current_class['subgroup'] == '2' ? 'selected' : ''; ?>>2</option>
                    </select><br>
                </td>
                <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
        <button type="submit" name="update_schedule">Обновить расписание</button>
    </form>
    <?php endif; ?>
</body>
</html>