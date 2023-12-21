<?php

session_start();
if (isset($_SESSION['user'])) {
    header('location:index.php');
}

$user    = 0;
$invalid_input = 0;

// Take action after form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'connect.php';

    // Input field value
    $email     = $_POST['email'];
    $password  = $_POST['password'];

    // Query search using email (email is uniqe field)
    $sql = "SELECT * FROM `register` WHERE email = '$email' AND user_password = '$password'";
    $result = mysqli_query($con, $sql);

    // Is user exist or not
    if ($result) {
        $num = mysqli_num_rows($result);

        if ($num > 0) {
            // Email exist.
            $user = 1;
            session_start();
            $_SESSION['user'] = $email;
            header('location: index.php');
        } else {
            $invalid_input = 1;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Sign In</title>
</head>

<body>

    <?php if ($invalid_input > 0) {
        echo '<div class="alart">
            <p>Email or Password is not match!!!</p>
        </div>';
    } ?>

    <div class="container">
        <div class="form">
            <div class="head">
                <h2>Log-In</h2>
            </div>
            <form action="log-in.php" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
                <label for="pass">Password</label>
                <input type="password" name="password" id="pass" placeholder="Enter your password" required>
                <input type="submit" value="Log In">
            </form>
            <p>Do not have an account! <a href="sign-up.php">Register Now</a></p>
        </div>
    </div>

</body>

</html>