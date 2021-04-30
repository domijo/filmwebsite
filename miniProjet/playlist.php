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
    $page ='Playlist';
    include_once "header.php";
    include_once 'database.php';

    if (isset($_POST["create"])) {
        if ($conn) {
            $query = "INSERT INTO playlists (title,creation_date,user_id) VALUES ('" . $_POST['playlistName'] . "', '" . date('Y-m-d') . "','" . $_SESSION['user_id'] . "')";
            if (mysqli_query($conn, $query)) {
            } else {
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }
    }
    if (isset($_POST["edit"])) {
        $_SESSION["playlistid"] = $_POST["id"];
        header("location: catalogue.php");
    }
    if (isset($_POST["delete"])) {
        $query = "DELETE FROM playlist_content WHERE playlist_id ='" .  $_POST['id'] . "';";
        mysqli_query($conn, $query);
        $query = "DELETE FROM playlists WHERE id = '" .  $_POST['id'] . "';";
        mysqli_query($conn, $query);
    }

    if ($conn) {
        $pQuery = "SELECT * FROM playlists WHERE user_id = '" . $_SESSION['user_id'] . "'";
        $results = mysqli_query($conn, $pQuery);
        $playlists = mysqli_fetch_all($results, MYSQLI_ASSOC);
        $moviesArray = [];
    }

    //$pQuery = "SELECT *, movies.title as movieTitle, playlists.title as playlistTitle FROM playlist_content INNER JOIN playlists ON playlist_id = playlists.id INNER JOIN movies ON movie_id = movies.id WHERE user_id = '" . $_SESSION['user_id'] . "'";
    ?>
    <div class="main-header">
        <h1><?php
            echo $_SESSION["firstName"];
            ?>'s playlists
        </h1>
        <section>
            <article>
                <?php foreach ($playlists as $playlist) : ?>
                    <div>
                        <p><?= $playlist['title']; ?></p>
                        <div class="playlistButton">
                            <form action="" method="POST">
                                <input type="hidden" name="id" value="<?= $playlist['id'] ?>">
                                <input class="button" type="submit" name="edit" value="Edit Playlist">
                            </form>
                            <form action="" method="POST">
                                <input type="hidden" name="id" value="<?= $playlist['id'] ?>">
                                <input class="button" type="submit" name="delete" value="delete">
                            </form>
                        </div>
                        <div class="filmList">
                            <?php

                            $movieQuery = "SELECT *, movies.title as movieTitle, playlists.title as playlistTitle FROM playlist_content INNER JOIN playlists ON playlist_id = playlists.id INNER JOIN movies ON movie_id = movies.id WHERE playlist_id = '" . $playlist['id'] . "'";
                            $movieResults = mysqli_query($conn, $movieQuery);
                            $movies = mysqli_fetch_all($movieResults, MYSQLI_ASSOC);

                            ?>
                            <?php foreach ($movies as $movie) : ?>
                                <img src="<?= $movie['poster']; ?>" alt="">
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </article>
        </section>

        <form action="" method="POST">
            <input class="input" type="text" name="playlistName" id="" placeholder="Playlist name">
            <input class="button" type="submit" value="Create" name="create">
        </form>
    </div>

</body>

</html>