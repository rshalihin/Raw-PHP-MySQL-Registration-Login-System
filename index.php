<?php

session_start();
if (!isset($_SESSION['user'])) {
    header('location:log-in.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Registration Home</title>
</head>

<body>

    <div class="container-body">
        <h1>Welcome
            <?php echo $_SESSION['user']; ?>
        </h1>
    </div>
    <div class="container-body">
        <a href="logout.php">Logout</a>
    </div>

</body>

</html>