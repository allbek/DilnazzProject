<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require('partials/globals.php') ?>
    <?php require('partials/header.php') ?>

  
    <div class="content">
        <h1>Админ-панель</h1>
        <div class="buttons">
            <a href="catalog_of_classes.php" class="btn">Расписание учеников</a>
            <a href="catalog_of_teachers.php" class="btn">Расписание учителей</a>
        </div>
    </div>

    
    <!-- footer -->
    <?php require('partials/footer.php') ?>

    
</body>

</html>