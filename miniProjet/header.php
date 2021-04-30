<?php

include_once "database.php";
session_start();

if ($conn) {
    $query = 'SELECT * FROM movies';

    $results = mysqli_query($conn, $query);

    $movies = mysqli_fetch_all($results, MYSQLI_ASSOC);
}
if (isset($_POST["stopPlaylist"])) {
    unset($_SESSION["playlistid"]);
}

?>
<header>
    <div id="navButtons">
        <a class="<?php if ($page == 'Homepage') {
                        echo 'active';
                    } ?>" href="homePage.php">HomePage</a>
        <a class="<?php if ($page == 'Catalogue') {
                        echo 'active';
                    } ?>" href="catalogue.php">Catalogue</a>
        <?php
        if (isset($_SESSION["isAdmin"])) {
            if ($_SESSION["isAdmin"] == 1) : ?>
                <a class='<?php if ($page == "Manage_Categories") {
                                echo "active";
                            } ?>' href='insertCategory.php'>Manage Categories</a>
                <a class="<?php if ($page == "Add_a_film") {
                                echo "active";
                            } ?>" href="insertFilm.php">Add a film</a>
            <?php endif;
        }
        if (isset($_SESSION['mail'])) : ?>
            <a class="<?php if ($page == "Playlist") {
                            echo "active";
                        } ?>" href="playlist.php">Playlist</a>
            <a class="<?php if ($page == "Log_out") {
                            echo "active";
                        } ?>" href="logout.php">Log out</a>
        <?php else : ?>
            <a href='login.php'>Log In</a>
        <?php endif; ?>
    </div>

    <?php if (isset($_SESSION["playlistid"])) : ?>
        <form action="" method="POST">
            <input type="submit" value="Stop editing playlist" name="stopPlaylist">
        </form>
    <?php endif; ?>
    <form action="details.php" method="post">
        <input list="movie" name="search" id="movies">
        <datalist id="movie">
            <?php foreach ($movies as $movie) : ?>
                <option value="<?= $movie["title"]; ?>">
                <?php endforeach; ?>
        </datalist>
        <input type="submit" class="btnsearch" value="Search">
    </form>

</header>
<hr>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>