<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require('partials/globals.php') ?>

    <?php require('partials/header.php') ?>

    <!-- Секция для входа пользователя -->
    <section class="contact-section spad">
        <div class="container">
            <!-- Форма входа -->
            <form action="signin.php" method="POST">
                <div class="container">
                    <h1>Вход</h1>
                    <p>Пожалуйста, заполните эту форму для входа в свой аккаунт.</p>
                    <hr>

                    <label for="login"><b>Почта</b></label>
                    <input type="text" placeholder="Введите вашу почту" name="userlogin" required>
                    
                    <label for="psw"><b>Пароль</b></label>
                    <input type="password" placeholder="Введите пароль" name="userpassword" required>
                    <hr>

                    <button type="submit" class="btn">Войти</button>
                </div>
            </form>
        </div>
    </section>

    <?php require('partials/footer.php') ?>
</body>
</html>
