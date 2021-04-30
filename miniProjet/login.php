<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php
    include_once "header.php";
    ?>
    <div class="main-header">
        <form action="" method="POST">
            <input class="input" type="email" name="email" placeholder="Email"><br>

            <input class="input" type="password" name="password" placeholder="Password"><br>

            <input class="button" type="submit" name="login" value="Log In">
            <input class="button" type="submit" name="forgotPassword" value="Forgot password?">
            <a class="create" href="register.php">Create an Account</a>
        </form>
        
    </div>


</body>

</html>


<?php
// If form was submitted
if (isset($_POST['login'])) {

    // Clean data from the form
    $mail = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Connect to DB
    include_once 'database.php';
    $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

    // Prepare query
    $query = "SELECT * 
    FROM user
    WHERE mail = '$mail'";


    // Execute query
    $results = mysqli_query($conn, $query);

    // How many records did I get ?
    $nb_records = mysqli_num_rows($results);

    // Does the user exists in my db ?
    if ($nb_records > 0) {

        $user = mysqli_fetch_assoc($results);

        // Check if passwords matches
        if (password_verify($password, $user['password'])) {
            session_start();
            // Save the mail (from my form) into the session
            $_SESSION['mail'] = $_POST['email'];

            header('Location: account.php');
        } else {
            echo 'Password doesnt mutch';
        }
    } else {
        echo "Invalid email or password";
    }
}

if (isset($_POST['forgotPassword'])) {
    header('Location: forgotPassword.php');

}

?>