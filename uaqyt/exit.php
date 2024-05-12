<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require('partials/globals.php') ?>

    <?php require('partials/header.php') ?>

    <section class="contact-section spad">
        <div class="container">
        <?php
            // Unsetting and destroying session data
            session_unset();
            session_destroy();
            header("Location: ../qrintent_new_version/index.php");
            ?>
        </div>
    </section>
    <?php require('partials/footer.php') ?>

    
</body>

</html>