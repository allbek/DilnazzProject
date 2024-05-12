<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php require('partials/globals.php') ?>

    <?php require('partials/header.php') ?>

    <?php
        // Retrieving user login and password from form submission
        $userlogin=$_POST['userlogin'];
        $userpassword=$_POST['userpassword'];

        // Querying the database to find the user with provided login
        $searchuser=mysqli_query($conn, "SELECT * FROM users WHERE userlogin='$userlogin'");
        $row = mysqli_fetch_array($searchuser);

        // Checking if user exists(verification)
        if(empty($row['userID'])){
            echo "User doesn't exist";
            header("refresh:2, url=index.php");
            exit();
        }
        else {
            // Verifications
            if ($userpassword==$row['userpassword']){
                // Starting session and storing user ID and login
                $_SESSION['userID']=$row['userID'];
                $_SESSION['userlogin']=$row['userlogin'];
                // Redirecting to index.php immediately
                header("refresh:0, url=index.php");
                exit();
            }
            else { 
                // Displaying message for wrong password
                echo "Wrong password!";
                // Redirecting to index.php after 2 seconds
                header("refresh:2, url=index.php");
                exit();
            }
        }
    ?>

    <!-- Including footer PHP file -->
    <?php require('partials/footer.php') ?>

</body>
</html>
