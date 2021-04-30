<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php
    //SESSION STARTED IN HEADER
    include_once "header.php";


    $errors = array();

    if (isset($_POST['btnReg'])) {
        $firstName = trim($_POST['firstName']);
        $lastName = trim($_POST['lastName']);
        $mail = trim($_POST['email']);
        $password = trim($_POST['password']);
        $sanitizeEmail = filter_var($mail, FILTER_SANITIZE_EMAIL);


        if (empty($firstName)) {
            $errors['firstName'] = 'First name is mandatory.<br>';
        }

        if (empty($lastName)) {
            $errors['lastName'] = 'Last name is mandatory.<br>';
        }

        if (!filter_var($sanitizeEmail, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email has to be a valid one.<br>';
        }

        if (empty($password)) {
            $errors['password'] = 'Password is mandatory.<br>';
        }

        if (strlen($password) < 8)
            $errors['password'] = 'Your password must be 8 character long';

        if (count($errors) == 0) {
            // join database
            include_once 'database.php';
            $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

            // check if email is already taken
            $query = "SELECT * FROM user WHERE mail = '$sanitizeEmail'";

            $resultMail = mysqli_query($conn, $query);


            if (mysqli_num_rows($resultMail) > 0) {
                $errors['email'] = 'Email already taken';
            } else {
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                // Insert to DB
                $query = "INSERT INTO user(firstName, lastName, mail, password)
        VALUES('$firstName', '$lastName ','$sanitizeEmail', '$hashPassword')";

                $result = mysqli_query($conn, $query);

                if ($result) {
                    // echo 'Insert successfull.';
                    $_SESSION['mail'] = $_POST['email'];
                    header('Location: account.php');
                } else {
                    echo 'Something went wrong inserting.';
                }
            }
        }
    }

    ?>
    <!-- Join module header -->
    <?php include_once "header.php"; ?>
    <div class="main-header">
        <form action="" method="POST">
            <input class="input" type="email" name="email" placeholder="Enter your email"><br>
            <?php if (isset($errors['email'])) echo $errors['email'] ?>

            <input class="input" type="text" name="firstName" placeholder="Enter your First name"><br>
            <?php if (isset($errors['firstName'])) echo $errors['firstName'] ?>

            <input class="input" class="input" type="text" name="lastName" placeholder="Enter your Last name"><br>
            <?php if (isset($errors['lastName'])) echo $errors['lastName'] ?>

            <input class="input" type="password" name="password" placeholder="Enter your password"><br>
            <?php if (isset($errors['password'])) echo $errors['password'] ?>

            <input class="button" type="submit" name="btnReg" value="Register">
        </form>
    </div>


</body>

</html>