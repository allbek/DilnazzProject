<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Управление расписанием</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require('partials/globals.php') ?>
    <?php require('partials/header.php') ?>
    <div class="content">
        <?php
        // Предположим, что подключение к базе данных уже настроено и доступно через $conn
        $days = ['Пн', 'Вт', 'Ср', 'Чт', 'Пт'];
        $times = ['8:30 - 9:10', '9:25 - 10:05', '10:20 - 11:00', '11:05 - 11:45', '12:05 - 12:45', '13:05 - 13:45', '13:50 - 14:30', '14:45 - 15:25', '15:40 - 16:20', '16:25 - 17:05'];
        if (isset($_POST['class_id']) && isset($_POST['subgroup_id'])) {
            $class_id = $_POST['class_id'];
            $subgroup_id = $_POST['subgroup_id'];
        }
        ?>

        <form action="" method="post">
            <label for="class_selector">Выберите класс:</label>
            <select id="class_selector" name="class_id">
                <option value="">--Выберите класс--</option>
                <?php
                    $query = "SELECT class_id, class_name FROM classes";
                    $result = $conn->query($query);
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['class_id']}'>{$row['class_name']}</option>";
                    }
                ?>
            </select>

            <label for="subgroup_selector">Выберите подгруппу:</label>
            <select id="subgroup_selector" name="subgroup_id">
                <option value="">--Выберите подгруппу--</option>
                <option value="1">1</option>
                <option value="2">2</option>
            </select>
            
            <button type="submit" name="show_schedule">Показать расписание</button>
        </form>

        <?php if (isset($_POST['show_schedule'])): ?>
            <form action="update_classes_schedule.php" method="post">
            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>">
            <input type="hidden" name="subgroup_id" value="<?php echo $subgroup_id; ?>">

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
                        $sql = "SELECT subject_id FROM schedule WHERE class_id = ? AND subgroup = ? AND day = ? AND time_slot = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("iiss", $class_id, $subgroup_id, $day, $time);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        $current_subject = $result->fetch_assoc();
                        ?>
                        <select name="subjects[<?php echo $day; ?>][<?php echo $time; ?>]">
                            <option value="">Выберите предмет</option>
                            <?php
                            $subjects_query = "SELECT subject_id, subject_name FROM subjects";
                            $subjects_result = $conn->query($subjects_query);
                            while ($subject = $subjects_result->fetch_assoc()) {
                                $selected = $current_subject['subject_id'] == $subject['subject_id'] ? 'selected' : '';
                                echo "<option value='{$subject['subject_id']}' $selected>{$subject['subject_name']}</option>";
                            }
                            ?>
                        </select>
                    </td>
                    <?php endforeach; ?>
                </tr>
                <?php endforeach; ?>
            </table>
            <button type="submit" name="update_schedule">Обновить расписание</button>
        </form>
    </div>
    <?php endif; ?>
</body>
</html>