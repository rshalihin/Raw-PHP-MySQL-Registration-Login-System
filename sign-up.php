<?php

session_start();
if (isset($_SESSION['user'])) {
    header('location:index.php');
}

$user    = 0;
$success = 0;

// Take action after form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include_once 'connect.php';

    // Input field value
    $user_name = $_POST['full_name'];
    $email     = $_POST['email'];
    $password  = $_POST['password'];

    // Query search using email (email is uniqe field)
    $sql = "SELECT * FROM `register` WHERE email = '$email'";
    $result = mysqli_query($con, $sql);

    // Is user exist or not
    if ($result) {
        $num = mysqli_num_rows($result);

        if ($num > 0) {
            // Email exist.
            $user = 1;
        } else {

            // Email dose not exist, Insert query.
            $sql = "INSERT INTO `register` (full_name, email, user_password ) VALUE ('$user_name', '$email', '$password')";

            $result = mysqli_query($con, $sql);

            if ($result) {
                $success = 1;
                header('location: log-in.php');
            } else {
                die(mysqli_error($con));
            }
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
    <title>Sign Up</title>
</head>

<body>
    <?php if ($user > 0) {
        echo '<div class="alart">
            <p>Email already exist!!! Please <a href="log-in.php">Log-in</a></p>
        </div>';
    } ?>

    <div class="container">
        <div class="form">
            <div class="head">
                <h2>Registration</h2>
            </div>
            <form action="sign-up.php" method="POST">
                <label for="fname">Full Name</label>
                <input type="text" name="full_name" id="fname" placeholder="Enter your full name">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
                <label for="pass">Password</label>
                <input type="password" name="password" id="pass" placeholder="Enter your password" required>
                <input type="submit" value="Sign Up">
            </form>
            <p>Already have an account! <a href="log-in.php">Log-In Now</a></p>
        </div>
    </div>

</body>

</html>