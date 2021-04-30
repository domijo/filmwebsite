<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>
    <?php
    include_once "database.php";
    include_once "header.php";
    if ($conn) {

        if (isset($_POST["id"])) {
            $query = 'SELECT * FROM movies INNER JOIN actors ON actor_id = actors.id WHERE movies.id = "' . $_POST["id"] . '";';
        }
        if (isset($_POST["search"])) {
            $query = 'SELECT * FROM movies INNER JOIN actors ON actor_id = actors.id WHERE movies.title = "' . $_POST["search"] . '";';
        }
        if (isset($_SESSION["id"]) && isset($_POST["id"])) {
            unset($_SESSION["id"]);
        }
        if (isset($_SESSION["id"])) {
            $query = 'SELECT * FROM movies INNER JOIN actors ON actor_id = actors.id WHERE movies.id = "' . $_SESSION["id"] . '";';
        }
        $results = mysqli_query($conn, $query);

        $movies = mysqli_fetch_assoc($results);
        $_SESSION["id"] = $movies["id"];
    }
    ?>

    <section>
        <div class="imgSide">
            <img src="<?= $movies["poster"] ?>" alt="">
            <p><?= $movies["title"] ?></p>
        </div>
        <div class="detailSide">
            <p><?= $movies["firstName"] . $movies["lastName"] ?></p>
            <p style="color:grey">"<?= $movies["synopsis"] ?></p>
        </div>

    </section>
</body>

</html>