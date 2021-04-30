<!-- Join module header -->

<?php
include_once "header.php";
include_once 'database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My account</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>

    <?php

    $query = 'SELECT * FROM user WHERE mail = "' . $_SESSION["mail"] . '";';

    $results = mysqli_query($conn, $query);

    $user = mysqli_fetch_assoc($results);
    $_SESSION["isAdmin"] = $user["isAdmin"];
    $_SESSION["firstName"] = $user["firstName"];
    $_SESSION["user_id"] = $user["id"];
    header("location: homePage.php")
    ?>


</body>

</html>