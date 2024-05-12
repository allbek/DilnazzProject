<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ-панель расписания</title>
    <link rel="stylesheet" href="style.css">

<body>
    <?php require('partials/globals.php') ?>
    <?php require('partials/header.php') ?>

  
    <div class="container">
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