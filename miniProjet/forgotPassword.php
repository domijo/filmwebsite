<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php
    include_once "header.php";
    include_once 'database.php';

    $errors = array();

    if (isset(($_POST['btnReset']))) {
        $mail = trim($_POST['email']);
        $sanitizeEmail = filter_var($mail, FILTER_SANITIZE_EMAIL);
        $password = trim($_POST['password']);


        if (!filter_var($sanitizeEmail, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email is mandatory.<br>';
        }

        if (empty($password)) {
            $errors['password'] = 'Password is mandatory.<br>';
        }

        if (strlen($password) < 8)
            $errors['password'] = 'Your password must be 8 character long';

        if (count($errors) == 0) {
            include_once 'database.php';
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

            $query = "SELECT * FROM user WHERE mail = '$sanitizeEmail'";

            $resultMail = mysqli_query($conn, $query);

            if (mysqli_num_rows($resultMail) < 1) {
                $errors['email'] = "Email doesn't mutch";
            } else {
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                // Insert to DB
                $query = "UPDATE user SET password='" . $hashPassword . "' WHERE mail = '" . $_POST['email'] . "';";

                $result = mysqli_query($conn, $query);

                if ($result) {
                    // echo 'Update successfull.';
                    $_SESSION['mail'] = $_POST['email'];
                    header('Location: account.php');
                } else {
                    echo 'Something went wrong reseting.';
                }
            }
        }
    }
    ?>


    
    <div class="main-header">
    <h2>Forgot your password?</h2>
    <p>Don't worry! Just fill your email and we will send you a link to reset your password.</p>
        <form action="" method="POST">
            <input class="input" type="email" name="email" placeholder="Enter your current email"><br>
            <?php if (isset($errors['email'])) echo $errors['email'] ?>
            <input class="input" type="password" name="password" placeholder="Enter your new password"><br>
            <?php if (isset($errors['password'])) echo $errors['password'] ?>
            <input class="button" type="submit" name="btnReset" value="Reset password">
        </form>
    </div>





</body>
</html>